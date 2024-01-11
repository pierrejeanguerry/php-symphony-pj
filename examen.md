# Examen PHP/Symfony

Distribué le 9 janvier 2024

À rendre le 26 janvier 2024

L'objectif de cet examen est de réaliser une application web de gestion de contenus en PHP/Symfony afin de valider les acquis.
Vous devrez jouer le rôle d'un développeur qui doit réaliser une application web pour un client sous la supervision d'un tech lead. Votre application sera soumise à l'équipe qualité qui validera le bon comportement de votre application.

Le projet est individuel.

Le sujet est découpé en plusieurs parties qui permettent de valider les compétences suivantes:

- Créer, développer et partager une application web en Symfony
- Mettre en place des outils de qualité de code
- Créer des routes et des contrôleurs avec Symfony
- Base de connaissances du moteur de template Twig
- Créer des formulaires avec Symfony
- Connaissances basiques de Doctrine
- Sécuriser une application web Symfony
- Connaissance basique pour réaliser une API à l'aide d'API Platform
- Connaissance basique du composant `symfony/console`
- Découvrir en autonomie un nouveau composant `symfony/Workflow`
- Tester son application web Symfony

---

## Rendu

Le rendu de l'examen se fera via la plateforme GitHub. Il est recommandé de pousser régulièrement son code afin de ne pas perdre votre travail.

Dès que le dépôt est créé, merci de m'envoyer le lien sur le Discord.

⚠ Il est impératif les 9/11/12 janvier de pousser votre code sur GitHub à la fin de chaque journée de cours.

Le dépôt de code doit être accessible, et vous devez vous assurer en amont de la date du butoir, que votre code est présent, et que votre projet est fonctionnel.
Il est impératif de respecter les consignes de rendu.

---

## Première Partie

**Application Web avec utilisation d'un moteur de template (Twig) et d'un ORM (Doctrine).**

Vous devez créer une application web Symfony qui permet de gérer des contenus.
Pour ce faire, il est nécessaire de créer une entité, qui n'aura dans un premier temps qu'un identifiant unique en base de données, et un contenu textuel.

Afin de collaborer avec d'éventuels collègues fictifs, vous devez utiliser les [migrations de Doctrine](https://symfony.com/bundles/DoctrineMigrationsBundle/current/index.html) durant tout le projet.
Elles vous permettront de créer une base de donnée, et de la mettre à jour facilement.
À chaque nouvelle itération du projet, utilisez les migrations pour mettre à jour votre base de données et ne touchez pas aux anciennes.

Vous devez ensuite créer une page d'accueil à l'aide de Twig qui affiche tous les contenus présents en base de données.
N'hésitez pas à créer plusieurs templates réutilisables, et pensez à la structure HTML dès le départ pour anticiper les évolutions futures.

Avoir une application responsive n'est pas demandé ni noté. Partez du principe qu'une largeur d'écran minimal de 1200px est disponible.
Le rendu de l'application n'est pas noté, mais elle doit être fonctionnelle et utilisable. Utilisez les intégrations/bundles Tailwind ou Bootstrap afin de gagner du temps.

Les contenus sur la page d'accueil doivent être paginés, et il doit être possible d'utiliser la pagination.

Enfin ajoutez une page dédiée, qui permet de consulter le contenu dans son intégralité.

Afin de vous aider à créer de nombreux contenus pour tester votre application, vous devez créer des fixtures à l'aide de [Doctrine Fixtures](https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html).
Vous pouvez également vous aider de Alice et [Faker](https://github.com/FakerPHP/Faker), qui permettent de générer des données aléatoires, au lieu d'écrire des fixtures à la main.

Concentrez-vous sur la qualité de votre code, et sur le respect des bonnes pratiques. Cette première partie permet de mettre en place les bases de votre projet.

Améliorez ensuite une fois que tout fonctionne, votre application en gérant la pagination, en amont de votre contrôleur, afin de rendre réutilisable votre code.
Pour ce faire il vous faut créer un DTO (Data Transfer Object) qui contiendra les données nécessaires à la pagination, et qui sera passé en paramètre de votre contrôleur.

Soyez attentif à la bonne gestion des erreurs, et au bon fonctionnement de votre première itération. Ajoutez également un logger, qui sort dans un fichier dans `/var/log`, et pensez à logger un maximum de choses en respectant [les niveaux d'erreurs](https://github.com/Seldaek/monolog/blob/main/doc/01-usage.md#log-levels).

---

## Deuxième Partie

**Authentification et autorisation des utilisateurs, formulaires.**

Vous devez maintenant rendre dynamique votre application web, en permettant aux utilisateurs de créer des contenus.
Pour cela, vous devez sécuriser votre application web, et créer des formulaires.

Avant toute chose, faites évoluer votre base de données. Vous avez maintenant besoin d'un utilisateur, et chaque contenu sera lié à un utilisateur.
Cet utilisateur aura un pseudo et un mot de passe, ainsi qu'un rôle (rédacteur ou éditeur ou admin).
Vous avez également besoin d'une table contenant des tags, qui seront liés à vos contenus.
Et enfin, vous avez besoin d'une date de publication pour vos contenus (datetime).

Ensuite faites évoluer votre header, afin d'ajouter un bouton de connexion et un bouton de déconnexion, en fonction de si l'utilisateur est connecté ou non.
Quand l'utilisateur est connecté, et possède le droit de "rédacteur", il aura un bouton pour ajouter des contenus dans le header.

Créez un formulaire et son contrôleur pour ajouter des contenus, qui doivent maintenant être lié à un rédacteur (utilisateur avec le droit rédacteur).
Un contenu possède un contenu textuel d'au moins 20 caractères, une date de publication dans le futur, et au moins un tag.
Vous devez vérifier ces pré-requis et afficher les erreurs correspondantes.

Adaptez votre page principale, pour que seuls les contenus ayant une date de publication dans le passé soit affichés.
Et modifiez vos fixtures, pour avoir quelques contenus avec une date de publication dans le futur.

Enfin, vous protégerez cette page afin qu'elle soit uniquement accessible aux rédacteurs connectés, et vous ferez en sorte que les boutons dans le header, s'affichent ou non en fonction de si l'utilisateur est connecté ou non, en respectant les droits requis.

---

## Troisième Partie

**Nouvelle fonctionnalité.**

Les contenus doivent à présent être validés par un éditeur avant d'être publiés.

Faites évoluer les fixtures, afin d'avoir un éditeur pour valider des contenus, et vos contenus pour en avoir des validés et des non validés.
Faites également évoluer votre base de données, pour ajouter un statut de publication à vos contenus, et une date de changement de statut.
Seuls les contenus validés sont maintenant visible sur la page d'accueil.

Ajoutez une nouvelle page dans votre application qui permettra aux éditeurs:

- de voir les contenus en attente de validation.
- de valider un contenu.
- d'archiver un contenu.
- de modifier un contenu.

Lors de la modification d'un contenu par un éditeur, uniquement les tags et la date de publication sont modifiables.

En bonus, vous pouvez utiliser le composant `symfony/workflow` pour gérer le cycle de vie des contenus.

---

## Quatrième Partie

**Utiliser des commandes pour maintenir votre application.**

Nous allons maintenant mettre en place des commandes afin de pouvoir maintenir votre application de manière pérenne.

La première commande que vous allez créer de permettre de lister tous les contenus archivés. Pour cela, vous utiliserez un rendu au format table.

La seconde commande que vous allez créer de permettre d'archiver tous les contenus non validés, vous devez afficher une barre de progression au fil des suppressions.

La troisième doit permettre de valider un contenu, en fonction de son identifiant.
Pour cela, vous devez soit fournir l'identifiant en tant que paramètre de votre commande, en dans le cas ou celui-ci ne serait pas fourni par l'utilisateur, une question interactive sera affichée pour recueillir l'identifiant.
