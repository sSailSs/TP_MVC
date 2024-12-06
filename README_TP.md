# Documentation de l'Application

## Introduction

Bienvenue dans l'application Laravel de gestion de stations-service. Cette application permet de gérer différentes entités telles que :

- **Voitures** : Informations sur les véhicules (marque, modèle, réservoir, quantité de carburant).
- **Stations Essence** : Gestion des informations des stations (nom, localisation, citernes).
- **Citernes** : Gestion des citernes et suivi des capacités/quantités de carburant.
- **Carburants** : Définition et gestion des types de carburants disponibles.

L'objectif est de fournir une application CRUD fonctionnelle avec des validations et des relations entre les entités.

---

## Prérequis

Avant d'installer l'application, assurez-vous que votre environnement respecte les prérequis suivants :

- **PHP** : >= 8.0
- **Laravel** : >= 10.x
- **Composer** : Gestionnaire de dépendances PHP
- **MySQL** : Base de données relationnelle
- **Node.js** (optionnel) : Pour le traitement des assets frontend

---

## Installation

### Étapes d'Installation

1. **Clonez le Dépôt :**
   ```bash
   git clone <URL_DU_DEPOT>
   cd <NOM_DU_PROJET>
