<?php

namespace App\Service\Questionnaire;

use App\Entity\Ability;
use App\Entity\Question;
use Doctrine\Common\Collections\Collection;

class QuestionManager
{
    /**
     * @param Ability[] $abilities
     * @param integer $nbQuestion
     * Number of questions by ability.
     * @return Question[]
     */
    public function getQuestions(array $abilities, int $nbQuestion): array
    {
        $result = [];
        foreach ($abilities as $ability) {
            $questions = $ability->getQuestions()->toArray();
            $this->shuffleQuestions($questions);
            $result = array_merge($result, array_slice($questions, 0, $nbQuestion));
        }

        return $this->shuffleQuestions($result);
    }

    /**
     * @param Question[] $questions
     * @return Question[]
     */
    private function shuffleQuestions(array $questions): array
    {
        shuffle($questions);
        return $questions;
    }
}
