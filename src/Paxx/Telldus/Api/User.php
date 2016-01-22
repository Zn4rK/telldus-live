<?php namespace Paxx\Telldus\Api;

class User extends BaseApi
{
    /**
     * Change the user's password. This function must be called over https
     *
     * @param string $currentPassword
     * @param string $newPassword
     * @return mixed
     */
    public function changePassword($currentPassword, $newPassword)
    {
        return $this->request('user/changePassword', array(
            'currentPassword' => $currentPassword,
            'newPassword'     => $newPassword
        ));
    }

    /**
     * Remove connection to this phone/user
     *
     * @param string $token - The unique phone id token used for pushing
     * @return mixed
     */
    public function deletePushToken($token)
    {
        return $this->request('user/deletePushToken', array(
            'token' => $token
        ));
    }

    /**
     * List all connected phones for this user
     *
     * @return array
     */
    public function listPhones()
    {
        $response = $this->request('user/listPhones');
        return $response['phone'];
    }

    /**
     * Gets information about the currently logged in user
     *
     * @return mixed
     */
    public function profile()
    {
        return $this->request('user/profile');
    }

    /**
     * Adds a phone in the system to be pushable
     *
     * @param $token - The unique phone id token used for pushing
     * @param $name - The name of this phone
     * @param $pushServiceId - The ID push_service_id
     * @param $model - (optional) - The model of this phone
     * @param $manufacturer - (optional) - The manufacturer of this phone
     * @param $osVersion - (optional) - The os-version of this phone
     * @return mixed
     */
    public function registerPushToken($token, $name, $pushServiceId, $model=null, $manufacturer=null, $osVersion=null)
    {
        return $this->request('user/registerPushToken', array(
            'token'         => $token,
            'name'          => $name,
            'pushServiceId' => $pushServiceId,
            'model'         => $model,
            'manufacturer'  => $manufacturer,
            'osVersion'     => $osVersion
        ));
    }

    /**
     * Don't push to this phone/user any more
     *
     * @param $token
     * @return mixed
     */
    public function unregisterPushToken($token)
    {
        return $this->request('user/unregisterPushToken', array(
            'token' => $token
        ));
    }
}