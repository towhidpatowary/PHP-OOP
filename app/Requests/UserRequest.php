<?php
declare(strict_types=1);

namespace App\Requests;

class UserRequest extends Request {
    public function __construct()
    {
       parent::__construct();
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'phone' => ['required']
        ];
    }

    public function validated(): array
    {
        $rules = $this->rules();

        return $this->validate($rules);
    }
}

?>