<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture
{
    const NEWS = [
        'La Tech été 2020' => [
            'article' => 'Associations et innovations',
            'image' => 'https://tuttonet.com/wp-content/uploads/2019/04/high-tech1.jpg',
            'description' => 'Cette année 2020 est longue en rebondissement, en passant par la pandemie, la crise ' .
                'sanitaire et bancaire, le secteur de la Tech reste tout de meme en expention, edit une conférence a ' .
                'Long Island sur la pérénité des association aux projets innovants.',
        ],
        'The buisness gate' => [
            'article' => 'Technologie et Buisness',
            'image' => 'https://www.telecomreview.info/images/stories/2017/09/news-28-09-06.jpg ',
            'description' => 'L\'inovation technologique touche à son paroxisme tout en offrant une possibilité ' .
                'grandissante d\'essort dans les domaines du Web et du Machine Learning',
        ],
        'Le futur du cellulaire' => [
            'article' => 'Telephonie et Responsive',
            'image' => 'http://netcomgroup-blog.fr/wp-content/uploads/2018/04/telephone-standard-telephonique.jpg ',
            'description' => 'Les telephones sont de nos jours les outils les plus utilisés par chacun d\'entre nous.' .
                ' La télé travail ne fait qu\'augmenter le chiffre d\'affaire grandissant des grandes ' .
                'multinationales du mobile',
        ],
        'L\'essor du génie civil' => [
            'article' => 'Grande Construction',
            'image' =>
                'https://image.freepik.com/photos-gratuite/plan-architecture-innovante-genie-civil_31965-6347.jpg',
            'description' => 'Les grand chantiers de début 2020 ont du revoir tout leur plan d\'infrastructure. ' .
                'En effet, les nouvelles préconisations en terme de santé occasionnent de nouveaux test et ' .
                'soulèvent de nombreuses questions.'
        ],
        'La rigueur des statistiques' => [
            'article' => 'De nombreux nombres',
            'image' =>
                'https://www.akamai.com/fr/fr/multimedia/images/intro/2018/big-data-connector-intro.jpg?imwidth=1366',
            'description' => 'Le big data a permis depuis plus de 10ans une connaissance accru des habitudes clients ' .
                'ce qui en a fait devenir une valeur non négligable pour toute entreprise '
        ],
        'Le géant Ubisoft' => [
            'article' => 'Du jeu video à l\'emploi',
            'image' =>
                'https://media2.ledevoir.com/images_galerie/nwl_605828_456493/image.jpg',
            'description' => 'Cela fait maintenant quelque temps que le geant Ubisoft s\'est implanté au port de ' .
                'la lune. Évidemment celui ci a permis de mettre la lumière sur le marché du développement en Gironde.'
        ],
        'Chantier Naval' => [
            'article' => 'Hissez haut',
            'image' =>
                'https://images.sudouest.fr/2016/04/29/57e105ea66a4bde778caaf00
                /widescreen/1000x500/reportage-dans-les-ateliers.jpg',
            'description' =>
                'Cela fait maintenant quelque temps que le geant Ubisoft s\'est implanté au port de la lune. ' .
                'Évidemment celui ci a permis de mettre la lumière sur le marché du développement en Gironde.'
        ],
        'Samsung Coin' => [
            'article' => 'DayTech',
            'image' =>
                'https://www.pwc.fr/fr/assets/images/2018/12/
                fr-france-555x312-shutterstock_1100777855.jpg.pwcimage.370.208.jpg',
            'description' => 'Le géant du high-tech va-t-il lancer sa propre cryptomonnaie ? En plus de ses gammes ' .
                'de smartphones, Samsung développe actuellement sa propre technologie blockchain. ' .
                'Elle pourrait aboutir à la création de sa monnaie virtuelle.'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::NEWS as $newsTitle => $data) {
            $news = new News();
            $news->setTitle($newsTitle)
                ->setArticle($data['article'])
                ->setImage($data['image'])
                ->setDescription($data['description']);
            $manager->persist($news);
        }
        $manager->flush();
    }
}
