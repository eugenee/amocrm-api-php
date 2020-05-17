<?php
/**
 * Класс AmoCompany. Содерит методы для работы с компаниями.
 *
 * @author    andrey-tech
 * @copyright 2019 andrey-tech
 * @see https://github.com/andrey-tech/amocrm-api
 * @license   MIT
 *
 * @version 1.0.0
 *
 * v1.0.0 (24.04.2019) Начальный релиз.
 *
 */

declare(strict_types = 1);

namespace AmoCRM;

class AmoCompany extends AmoObject
{
    /**
     * Путь для запроса к API
     * @var string
     */
    const URL = '/api/v2/companies';

    /**
     * @var array
     */
    public $leads = [];

    /**
     * @var array
     */
    public $contacts = [];

    /**
     * @var array
     */
    public $customers = [];

    /**
     * @var int
     */
    public $closest_task_at;

    /**
     * Конструктор
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Приводит модель к формату для передачи в API
     * @return array
     */
    public function getParams() :array
    {
        $params = [];

        if (isset($this->closest_task_at)) {
            $params['closest_task_at'] = $this->closest_task_at;
        }

        if (count($this->leads)) {
            $params['leads_id'] = $this->leads['id'];
        }
        
        if (count($this->contacts)) {
            $params['contacts_id'] = $this->contacts['id'];
        }
        
        if (count($this->customers)) {
            $params['customers_id'] = $this->customers['id'];
        }
        
        return array_merge(parent::getParams(), $params);
    }

    /**
     * Добавляет задачи
     * @param array | int $leads
     * @return AmoCompany
     *
     */
    public function addLeads($leads) :AmoCompany
    {
        if (! is_array($leads)) {
            $leads = [ $leads ];
        }
        
        if (isset($this->leads['id'])) {
            foreach ($leads as $id) {
                if (! in_array($id, $this->leads['id'])) {
                    $this->leads['id'][] = $id;
                }
            }
        } else {
            $this->leads['id'] = $leads;
        }

        return $this;
    }

    /**
     * Добавляет контакты
     * @param array | int $contacts
     * @return AmoCompany
     *
     */
    public function addContacts($contacts) :AmoCompany
    {
        if (! is_array($contacts)) {
            $contacts = [ $contacts ];
        }
        
        if (isset($this->contacts['id'])) {
            foreach ($contacts as $id) {
                if (! in_array($id, $this->contacts['id'])) {
                    $this->contacts['id'][] = $id;
                }
            }
        } else {
            $this->contacts['id'] = $contacts;
        }

        return $this;
    }

    /**
     * Добавляет покупателей
     * @param array | int $customers
     * @return AmoCompany
     *
     */
    public function addCustomers($customers) :AmoCompany
    {
        if (! is_array($customers)) {
            $customers = [ $customers ];
        }
        
        if (isset($this->customers['id'])) {
            foreach ($customers as $id) {
                if (! in_array($id, $this->customers['id'])) {
                    $this->customers['id'][] = $id;
                }
            }
        } else {
            $this->customers['id'] = $customers;
        }

        return $this;
    }
}