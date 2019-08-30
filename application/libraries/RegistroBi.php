<?php

class RegistroBi
{
    public function RegistroBi()
    {
        $CI = &get_instance();
        $CI->load->model('registroDao');
        $this->dao = $CI->registroDao;
    }

    public function agregarRegistro($registro, $email)
    {
        return $this->dao->agregarRegistro($registro);
    }

//     public function sendMail($email)
    //     {
    //         $email->from('admin@@ccgro.com.mx', 'Portal Web Información');
    //         $email->to('sacorus@gmail.com');
    //         $email->subject('Email Test');
    //         $email->message('Testing the email class.');
    //         if($email->send())
    //             return true;
    //         echo $email->print_debugger();

// /*
    // $message = '';
    // $this->load->library('email',);
    // $this->email->set_newline("\r\n");
    // $this->email->from('sacorus@gmail.com'); // change it to yours
    // $this->email->to('sacorus@gmail.com'); // change it to yours
    // $this->email->subject('Resume from JobsBuddy for your Job posting');
    // $this->email->message($message);
    // if ($this->email->send()) {
    // return true;
    // } else {
    // show_error($this->email->print_debugger());
    // return false;
    // }*/

//     }
}
