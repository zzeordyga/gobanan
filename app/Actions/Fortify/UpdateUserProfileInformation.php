<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'username' => ['required', 'string', 'max:24', Rule::unique('users')->ignore($user->id), 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'dob' => ['required', 'date', 'before:-18 years'],
            'phone' => ['nullable', 'numeric', 'min:10'],
        ],
        [
            'dob.before' => "You must at least be 18 years old."
        ])->validateWithBag('updateProfileInformation');

        // if (isset($input['photo'])) {
        //     $user->updateProfilePhoto($input['photo']);
        // }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $data = [
                'name' => $input['name'],
                'email' => $input['email'],
                'username' => $input['username'],
                'dob' => $input['dob'],
            ];

            if(isset($input['phone'])){
                $data['phone'] = $input['phone'];
            }

            if(isset($input['photo'])){

                $file = $input['photo'];
                $imageName = time().'.'.$file->getClientOriginalExtension();
                Storage::putFileAs('public/profile-pictures', $file, $imageName);
                $imageName = 'profile-pictures/'.$imageName;

                $data['picture'] = $imageName;
            }

            $user->forceFill($data)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
