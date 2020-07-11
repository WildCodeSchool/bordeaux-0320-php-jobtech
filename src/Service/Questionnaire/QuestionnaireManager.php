<?php

namespace App\Service\Questionnaire;

use App\Entity\Ability;
use App\Entity\Question;
use App\Entity\Questionnaire;

class QuestionnaireManager
{
    public const SCALE_WANTED = 100;
    public const MAX_SCORE_BY_QUESTION = 5;
    private const ABILITY = 'ability';

    /**
     * @param Questionnaire[] $questionnaires
     * @return array
     */
    public function prepareDataForChart(array $questionnaires): array
    {
        $result = [];
        foreach ($questionnaires as $questionnaire) {
            if ($questionnaire->getAbility()->getIsProfessional()) {
                $result['pro']['ability'][] = $questionnaire->getAbility()->getTitle();
                $result['pro']['score'][] = $questionnaire->getScore();
            } else {
                $result['perso']['ability'][] = $questionnaire->getAbility()->getTitle();
                $result['perso']['score'][] = $questionnaire->getScore();
            }
        }
        $result['postedAt'] = $questionnaires[0]->getPostedAt();

        return $result;
    }

    /**
     * @param Ability[] $abilities
     * @param array $resultQuestionnaire
     * @return boolean
     */
    public function isCorrectAbilities(array $abilities, array $resultQuestionnaire): bool
    {
        $abilitiesConfirmed = [];
        foreach ($abilities as $ability) {
            $abilitiesConfirmed[] = $ability->getId();
        }

        $result = true;
        foreach ($resultQuestionnaire as $key => $value) {
            if (strpos($key, self::ABILITY) === 0 && !in_array($value, $abilitiesConfirmed)) {
                $result = false;
            }
        }

        return $result;
    }

    /**
     * @param array $resultQuestionnaire
     * @param Ability[] $abilities
     * @return array
     */
    public function calculateAbilities(array $resultQuestionnaire, array $abilities): array
    {
        $nbQuestion = count($resultQuestionnaire) / 2;
        $result = [];
        for ($i = 0; $i < $nbQuestion; $i++) {
            if (!array_key_exists($resultQuestionnaire['ability' . $i], $result)) {
                $result[$resultQuestionnaire['ability' . $i]] = 0;
            }

            $result[$resultQuestionnaire['ability' . $i]] += $resultQuestionnaire['question' . $i];
        }

        return $this->convertScaleTo100($result, $abilities);
    }

    /**
     * @param Ability[] $abilities
     * @return Question[]
     */
    public function getQuestions(array $abilities): array
    {
        $result = array_map([__CLASS__, 'prepareQuestions'], $abilities);
        $result = array_merge(...$result);
        shuffle($result);

        return $result;
    }

    private function prepareQuestions(Ability $ability): array
    {
        $questions = $ability->getQuestions()->toArray();
        shuffle($questions);
        return array_slice($questions, 0, $ability->getNbQuestion());
    }

    /**
     * @param array $result
     * @param Ability[] $abilities
     * @return array
     */
    private function convertScaleTo100(array $result, array $abilities): array
    {
        $coef = [];
        foreach ($abilities as $ability) {
            $coef[$ability->getId()] = self::SCALE_WANTED / ($ability->getNbQuestion() * self::MAX_SCORE_BY_QUESTION);
        }

        foreach ($result as $ability => $value) {
            $result[$ability] = (int) round($value * $coef[$ability]);
        }

        return $result;
    }
}
