<?php

namespace App\Presenters;

use App\Components\ChangePasswordForm;
use App\Components\LoginCheck\LoginCheckFactory;
use App\Entity\User;
use App\Repository\UserRepository;
use Nette\Security\Passwords;

class SettingsPresenter extends BasePresenter
{

    private User $userEntity;
    private Passwords $passwords;
    private UserRepository $userRepository;

    public function __construct(LoginCheckFactory $loginCheckFactory, Passwords $passwords, UserRepository $userRepository)
    {
        parent::__construct($loginCheckFactory);
        $this->passwords = $passwords;
        $this->userRepository = $userRepository;
    }

    public function startup()
    {
        parent::startup();
        if(!$this->user->isLoggedIn()){
            $this->flashMessage('Musíte se nejdříve přihlásit.');
            $this->redirect('Articles:default');
        }

        $this->userEntity = $this->user->getIdentity()->getData()['entity'];

    }


    public function renderDefault(){

    }

    public function createComponentChangePasswordForm(){
        $form = new ChangePasswordForm();
        $form->onSuccess[] = [$this, 'onSuccess'];

        return $form;
    }

    public function onSuccess(ChangePasswordForm $form, $data): bool{

        if($data['new_password1'] !== $data['new_password2']){
            $this->flashMessage('Hesla se neshodují', 'error');
            return false;
        }

        if(!$this->passwords->verify($data['old_password'] . $this->userEntity->getEmail(), $this->userEntity->getPassword())){
            $this->flashMessage('Neplatné heslo', 'error');
            return false;
        }

        $newPasswordHash = $this->passwords->hash($data['new_password1'] . $this->userEntity->getEmail());
        $this->userEntity->setPassword($newPasswordHash);
        $this->userRepository->updateUser($this->userEntity);

        $this->flashMessage('Heslo úspěšně změneno. ' . $newPasswordHash, 'success');
        return true;
    }
}