<?php

namespace Dsone\Presenters;


class ClientPresenter extends Presenter
{

    /**
     * @return string
     */
    public function name(): string
    {
        return sprintf("%s %s", $this->model->nom, $this->model->prenom);
    }


    /**
     * @return string
     */
    public function fullAddress(): string
    {
        $client = $this->model;
        return $client->address . "," . $client->commune->name . "," . $client->wilaya->name;
    }


}
