<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Complaint extends Model
{
    use HasFactory;

    const STATUS_MENUNGGU = 'menunggu';
    const STATUS_DIPROSES = 'diproses';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';

    public static array $statuses = [
        self::STATUS_MENUNGGU => 'Menunggu Verifikasi',
        self::STATUS_DIPROSES => 'Sedang Diproses',
        self::STATUS_SELESAI => 'Selesai',
        self::STATUS_DITOLAK => 'Ditolak',
    ];

    protected $fillable = [
        'ticket_number',
        'category_id',
        'name',
        'email',
        'phone',
        'subject',
        'description',
        'attachment_path',
        'status',
        'assigned_to',
    ];

    protected static function booted(): void
    {
        static::creating(function (Complaint $complaint) {
            if (empty($complaint->ticket_number)) {
                $complaint->ticket_number = 'ADU-'.now()->format('Ymd').'-'.strtoupper(Str::random(5));
            }
            if (empty($complaint->status)) {
                $complaint->status = self::STATUS_MENUNGGU;
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function responses()
    {
        return $this->hasMany(ComplaintResponse::class)->orderBy('created_at');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function statusLabel(): string
    {
        return self::$statuses[$this->status] ?? $this->status;
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_MENUNGGU => 'bg-yellow-100 text-yellow-800',
            self::STATUS_DIPROSES => 'bg-blue-100 text-blue-800',
            self::STATUS_SELESAI => 'bg-green-100 text-green-800',
            self::STATUS_DITOLAK => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
