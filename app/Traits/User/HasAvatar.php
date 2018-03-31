<?php

namespace App\Traits\User;

use App\Avatar;

trait HasAvatar
{
    /**
     * Get the avatar that belongs to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    /**
     * Add the avatar.
     *
     * @param array $data
     * @param string $path
     */
    public function addAvatar($data, $path)
    {
        $this->changeAvatarPath($data, $path);

        $this->changeAvatar($data);
    }

    /**
     * Remove the avatar.
     *
     * @param string $path
     */
    public function removeAvatar($path)
    {
        $this->removeAvatarFromDestination($path);

        $this->deleteAvatar();
    }

    /**
     * Change the avatar path in the storage.
     *
     * @param  array $data
     */
    protected function changeAvatarPath($data, $path)
    {
        $myArray = $data->all();

        $file = $data['avatar'];
        $fileName = $file->getClientOriginalName();

        $this->removeAvatarFromDestination($path);
        $file->move($path, $fileName);
    }

    /**
     * Change the avatar in the database.
     *
     * @param  array $data
     */
    protected function changeAvatar($data)
    {
        $avatar = $this->avatar ?: new Avatar;

        $avatar->filename = $data['avatar']->getClientOriginalName();

        $this->saveAvatar($avatar);
    }

    /**
     * Remove the avatar from the storage.
     *
     * @param string $path
     *
     */
    protected function removeAvatarFromDestination($path)
    {
        $this->avatar ? unlink($path .'/' .$this->avatar->filename) : '';
    }

    /**
     * Save the avatar in the database.
     *
     * @param  \App\Avatar $avatar
     *
     */
    protected function saveAvatar($avatar)
    {
        $this->avatar()->save($avatar);
    }

    /**
     * Remove the avatar from the database.
     *
     */
    public function deleteAvatar()
    {
        optional($this->avatar)->delete();
    }
}