<?php

namespace App\locoform\Domain\Model;

use App\locoform\Infrastructure\Config;
use RedBeanPHP\R as R;

class Form
{
    private const NAME = Config::DB_PREFIX . '_form';

    private int $id = 0;
    private string $code;
    private string $name;

    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

    public function load(int $id): void
    {

    }

    public function save(): void
    {
        if ($this->id === 0) {
            $form = R::locoDispense(self::NAME);
        } else {
            $form = R::load(self::NAME, $this->id);
        }
        $form->code = trim($this->code);
        $form->name = trim($this->name);
        $this->id = R::store($form);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

}