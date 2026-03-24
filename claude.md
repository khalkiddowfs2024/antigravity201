# Projet Laravel — Gestion des Absences des Étudiants

## Contexte

Application web développée avec **Laravel** pour gérer les absences des étudiants dans un établissement scolaire. Elle permet aux enseignants de saisir les absences, aux responsables de les suivre et aux étudiants/parents de les consulter.

---

## Stack Technique

- **Framework** : Laravel 12+
- **Base de données** : MySQL
- **Frontend** : Blade + Bootstrap 5 (ou Tailwind CSS)
- **Auth** : Laravel Breeze / Fortify
- **Rôles** : Spatie Laravel Permission

---

## Rôles Utilisateurs

| Rôle         | Permissions principales                                              |
|--------------|----------------------------------------------------------------------|
| `admin`      | Gestion complète (utilisateurs, classes, matières, absences)        |
| `enseignant` | Saisie des absences pour ses cours                                   |
| `etudiant`   | Consultation de ses propres absences                                 |
| `parent`     | Consultation des absences de son/ses enfant(s)                      |

---

## Modèles & Relations

### `User`
- `name`, `email`, `password`, `role`
- Un utilisateur peut être lié à un ou plusieurs rôles via Spatie

### `Classe`
- `nom` (ex : "Terminale A"), `niveau`, `annee_scolaire`
- HasMany → `Etudiant`, `Cours`

### `Matiere`
- `nom`, `code`
- HasMany → `Cours`

### `Cours`
- `classe_id`, `matiere_id`, `enseignant_id`, `date`, `heure_debut`, `heure_fin`
- BelongsTo → `Classe`, `Matiere`, `User (enseignant)`
- HasMany → `Absence`

### `Etudiant`
- `user_id`, `classe_id`, `numero_matricule`, `date_naissance`
- BelongsTo → `User`, `Classe`
- HasMany → `Absence`

### `Absence`
- `etudiant_id`, `cours_id`, `statut` (absent|present|retard|justifie), `motif`, `justifie_at`
- BelongsTo → `Etudiant`, `Cours`

### `Justification`
- `absence_id`, `document_path`, `commentaire`, `valide_par`, `valide_at`

---

## Fonctionnalités

### Administration
- [ ] CRUD Utilisateurs avec assignation de rôles
- [ ] CRUD Classes / Niveaux / Années scolaires
- [ ] CRUD Matières
- [ ] Affectation enseignants → matières → classes
- [ ] Tableau de bord statistiques globales

### Enseignant
- [ ] Liste de ses cours du jour / de la semaine
- [ ] Feuille de présence par cours (liste des étudiants + statut)
- [ ] Historique des absences par cours

### Étudiant / Parent
- [ ] Consultation du récapitulatif des absences
- [ ] Soumission d'une justification (avec pièce jointe)
- [ ] Notifications par email (absence enregistrée, justification validée)

### Rapports
- [ ] Export PDF / Excel des absences par classe, par étudiant, par période
- [ ] Alertes automatiques si seuil d'absences dépassé (ex. > 3 absences non justifiées)

---

## Structure des Routes

```
/                          → Accueil / Tableau de bord
/login, /register          → Auth

/admin/users               → Gestion utilisateurs
/admin/classes             → Gestion classes
/admin/matieres            → Gestion matières
/admin/cours               → Gestion plannings

/enseignant/cours          → Mes cours
/enseignant/cours/{id}/presences → Saisie présences

/etudiant/absences         → Mes absences
/etudiant/justifications   → Mes justifications

/parent/enfants            → Mes enfants
/parent/absences/{etudiant} → Absences d'un enfant

/rapports/absences         → Export & rapports
```

---

## Migrations Clés

```bash
php artisan make:migration create_classes_table
php artisan make:migration create_matieres_table
php artisan make:migration create_cours_table
php artisan make:migration create_etudiants_table
php artisan make:migration create_absences_table
php artisan make:migration create_justifications_table
```

---

## Commandes de Démarrage

```bash
# Installer les dépendances
composer install
npm install && npm run dev

# Configuration
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate --seed

# Lancer le serveur
php artisan serve
```

---

## Seeders

- `RoleSeeder` → Créer les rôles (`admin`, `enseignant`, `etudiant`, `parent`)
- `UserSeeder` → Comptes de test pour chaque rôle
- `ClasseSeeder` → Quelques classes de démonstration
- `MatiereSeeder` → Matières de base
- `CoursSeeder` → Planning de cours factice
- `EtudiantSeeder` → Étudiants de démonstration
- `AbsenceSeeder` → Absences générées aléatoirement

---

## Packages Recommandés

| Package                        | Usage                            |
|-------------------------------|----------------------------------|
| `spatie/laravel-permission`   | Gestion des rôles & permissions  |
| `barryvdh/laravel-dompdf`     | Export PDF                       |
| `maatwebsite/excel`           | Export Excel                     |
| `laravel/breeze`              | Authentification                 |
| `spatie/laravel-activitylog`  | Journal des actions              |

---

## Conventions de Code

- **Langue** : Français pour les noms de champs métier, Anglais pour le code technique
- **Controllers** : Un controller par ressource, méthodes RESTful
- **Policies** : Vérification des autorisations via Policies Laravel
- **Form Requests** : Validation dans des classes dédiées `StoreAbsenceRequest`, etc.
- **Tests** : Feature tests pour les routes critiques
