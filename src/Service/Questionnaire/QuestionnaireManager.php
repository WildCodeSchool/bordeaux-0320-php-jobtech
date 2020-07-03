<?php

namespace App\Service\Questionnaire;

use App\Controller\QuestionnaireController;
use App\Entity\Ability;
use App\Entity\Question;

class QuestionnaireManager
{
    const SCALE_WANTED = 100;
    const MAX_SCORE_BY_QUESTION = 5;

    /**
     * @param Ability[] $abilities
     * @param array $resultQuestionnaire
     * @return boolean
     */
    public function isCorrectAbilities(array $abilities, array $resultQuestionnaire): bool
    {
        // foreach ($abilities as $key => $value) {
        //    # code...
        // }
        return true;
    }

    /**
     * @param array $resultQuestionnaire
     * @return array
     */
    public function calculateAbilities(array $resultQuestionnaire): array
    {
        $nbQuestion = count($resultQuestionnaire) / 2;
        $result = [];
        for ($i = 0; $i < $nbQuestion; $i++) {
            if (!array_key_exists($resultQuestionnaire['ability' . $i], $result)) {
                $result[$resultQuestionnaire['ability' . $i]] = 0;
            }

            $result[$resultQuestionnaire['ability' . $i]] += $resultQuestionnaire['question' . $i];
        }

        return $this->convertScaleTo100($result);
    }

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

    private function convertScaleTo100(array $result): array
    {
        $coef = self::SCALE_WANTED/(QuestionnaireController::NB_OF_QUESTIONS_BY_ABILITY*self::MAX_SCORE_BY_QUESTION);

        foreach ($result as $ability => $value) {
            $result[$ability] = (int) round($value * $coef);
        }

        return $result;
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
