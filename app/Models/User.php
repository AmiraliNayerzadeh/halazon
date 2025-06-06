<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'gender',
        'phone',
        'email',
        'nationalCode',
        'id_card',
        'birthday',
        'address',
        'postalCode',
        'avatar',
        'video',
        'description',
        'last_certificate',
        'resume',
        'is_verify',
        'is_admin',
        'is_teacher',
        'slug',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function isTeacher()
    {
        return $this->is_teacher == 1;
    }

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'teacher_id', 'user_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'teacher_id');
    }

    public function schedules()
    {
        return $this->hasMany(CourseSchedule::class, 'teacher_id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getComments()
    {
        return $this->morphMany(Comment::class, 'commentable');

    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    public function courseOrders()
    {
        return $this->hasMany(CourseOrder::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }


    public function hasAccessToPart($courseId, $partId = null)
    {
        return $this->userCourses()->where('course_id', $courseId)->where('part_id', $partId)->exists();
    }

    public function hasAccessToCourse($courseId)
    {
        return $this->userCourses()->where('course_id', $courseId)->exists();
    }


}
