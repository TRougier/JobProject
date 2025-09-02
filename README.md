# SearchJob – Gestion de candidatures

**SearchJob** est une application web Symfony qui permet aux utilisateurs de suivre, organiser et optimiser leurs candidatures, relances et entretiens grâce à un tableau de type **Kanban**, avec une intégration d’API pour récupérer des offres d’emploi.

---

## 🚀 Fonctionnalités principales

### 1. Tableau Kanban
- Trois colonnes : **Candidature envoyée**, **Relance**, **Entretien**.
- Possibilité de déplacer les candidatures entre les colonnes par **drag & drop**.  
- La **date de dernière mise à jour** se met automatiquement à jour à chaque mouvement et rechargement de la page.

### 2. Gestion des candidatures
- Ajouter ou supprimer une candidature.  
- Chaque candidature contient : nom, lien vers l’offre et date de mise à jour.  
- Bouton de suppression avec confirmation pour éviter les erreurs.

### 3. Statistiques
- Compte le nombre de candidatures par statut.  
- Les chiffres se mettent à jour **à chaque rechargement de page**.

### 4. Intégration API Jooble
- Page dédiée pour afficher les offres d’emploi depuis l’API Jooble.  
- Utilise une **clé API personnelle**, à définir dans le fichier `.env`.  
- Limite de 500 requêtes par mois sur le plan gratuit.  

**Pour utiliser ton propre compte :**
1. Crée un compte Jooble.  
2. Génére une clé API personnelle.  
3. Remplace la clé dans `.env` :  
```env
JOOBLE_API_KEY=ta_cle_api


## 5. Authentification
- Authentification via email et mot de passe.  
- Chaque utilisateur ne peut voir et modifier que ses propres candidatures.

---

## ⚙️ Installation

1. **Cloner le projet**  
```bash
git clone https://github.com/TRougier/SearchJob.git
cd SearchJob

Installer les dépendances

composer install

Creer sa BDD
php bin/console doctrine:database:create

Exécuter les migrations
php bin/console doctrine:migrations:migrate


Lancer le serveur :
symfony server:start
Le projet est accessible à l’adresse : http://127.0.0.1:8000


Utilisation
Kanban : glisse une candidature vers une autre colonne pour changer son statut.
Ajouter candidature : clique sur “Nouvelle candidature” et remplis le formulaire.
Supprimer candidature : clique sur le bouton “Supprimer” dans chaque carte.
Statistiques : les nombres se mettent à jour au rechargement de la page.
Offres d’emploi : consulte les offres récupérées via l’API Jooble.


Back-end : PHP, Symfony 6
Base de données : MySQL
Front-end : HTML, CSS, JavaScript
API : Jooble 
