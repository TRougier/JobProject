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

env:
JOOBLE_API_KEY=ta_cle_api


### 5. Authentification
- Authentification via email et mot de passe.  
- Chaque utilisateur ne peut voir et modifier que ses propres candidatures.

---

### 📝 Utilisation

- **Kanban** : glisse une candidature vers une autre colonne pour changer son statut.
- **Ajouter une candidature** : clique sur "Nouvelle candidature" et remplis le formulaire.
- **Supprimer une candidature** : clique sur le bouton "Supprimer" dans chaque carte.
- **Statistiques** : les nombres se mettent à jour à chaque rechargement de la page.
- **Offres d’emploi** : consulte les offres récupérées via l’API Jooble.

---

### 🛠️ Technologies

- **Back-end** : PHP, Symfony 6
- **Base de données** : MySQL
- **Front-end** : HTML, CSS, JavaScript
- **API** : Jooble

## Installation du projet

Pour installer le projet comme un nouvel utilisateur, suis ces étapes :

1. **Cloner le dépôt**
  git clone https://github.com/TRougier/JobProject.git

  cd JobProject
  
**Configurer les variables d’environnement**
-  Renomme le fichier .env.example en .env :  
-  Editer le fichier .env pour renseigner tes informations locales  

  ```composer install  
  php bin/console doctrine:database:create  
  php bin/console doctrine:migrations:migrate  
  symfony server:start

