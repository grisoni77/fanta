<?php

namespace Fc\FantaBundle\Competition\Builder;

use Fc\FantaBundle\Competition\CompetitionDataInterface;

/**
 * Description of CompetitionBuilderInterface
 *
 * @author 71537
 */
interface CompetitionBuilderInterface 
{
    public function createCompetition(CompetitionDataInterface $data);
}