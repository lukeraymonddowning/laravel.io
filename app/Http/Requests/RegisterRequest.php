<?php

namespace App\Http\Requests;

use App\Rules\UniqueGitHubUser;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|alpha_dash|max:40|unique:users',
            'rules' => 'accepted',
            'terms' => 'accepted',
            'github_id' => ['required', new UniqueGitHubUser],
        ];
    }

    public function name(): string
    {
        return $this->get('name');
    }

    public function emailAddress(): string
    {
        return $this->get('email');
    }

    public function username(): string
    {
        return $this->get('username');
    }

    public function githubId(): string
    {
        return $this->get('github_id');
    }

    public function githubUsername(): string
    {
        return $this->get('github_username', '');
    }
}
