<?php

namespace App\Models;

use App\Services\PermissionRole\HasPermissionRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SplObserver;

class Role extends Model implements \SplSubject
{
    use HasFactory, HasPermissionRole;

    private $observers;

    public function __construct(array $attributes = [])
    {
        $this->observers = new \SplObjectStorage();
        parent::__construct($attributes);
    }

    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
