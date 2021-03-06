<?php
//******************************************************************************
//                                       app.php
// SILEX-PHIS
// Copyright © INRA 2017
// Creation date:  Mar., 2017
// Contact: morgane.vidal@inra.fr,arnaud.charleroy, anne.tireau@inra.fr, pascal.neveu@inra.fr
//******************************************************************************

/**
 * French translations of this application
 * @link https://www.yiiframework.com/extension/translate
 * @update [Arnaud Charleroy] 24 August, 2018: widgets translations
 */

use app\models\yiiModels\YiiAnnotationModel;
use app\components\widgets\AnnotationGridViewWidget;
use app\components\widgets\AnnotationButtonWidget;
use app\models\yiiModels\YiiEventModel;
use app\models\yiiModels\EventPost;
use app\components\widgets\EventButtonWidget;
use app\components\widgets\EventGridViewWidget;
use app\components\widgets\PropertyWidget;

return [
    '{n, plural, =1{Project} other{Projects}}' => '{n, plural, =1{Projet} other{Projets}}',
    '{n, plural, =1{Experiment} other{Experiments}}' => '{n, plural, =1{Expérimentation} other{Expérimentations}}',
    '{n, plural, =1{Group} other{Groups}}' => '{n, plural, =1{Groupe} other{Groupes}}',
    '{n, plural, =1{User} other{Users}}' => '{n, plural, =1{Utilisateur} other{Utilisateurs}}',
    '{n, plural, =1{Person} other{Persons}}' => '{n, plural, =1{Personne} other{Personnes}}',
    '{n, plural, =1{Sensor} other{Sensors}}' => '{n, plural, =1{Capteur} other{Capteurs}}',
    '{n, plural, =1{Vector} other{Vectors}}' => '{n, plural, =1{Vecteur} other{Vecteurs}}',
    '{n, plural, =1{Radiometric Target} other{Radiometric Targets}}' => '{n, plural, =1{Cible Radiométrique} other{Cibles Radiométriques}}',
    '{n, plural, =1{Scientific Object} other{Scientific Objects}}' => '{n, plural, =1{Objet Scientifique} other{Objets Scientifiques}}',
    '{n, plural, =1{Scientific frame} other{Scientific frames}}' => '{n, plural, =1{Cadre scientifique} other{Cadres scientifiques}}',
    
    'A radiometric target can be described by the value of its coefficients to the bidirectional reflectance distribution function (see the BRDF ' => 'Une cible radiométrique peut être décrite par la valeur de ses coefficients à la fonction de distribution de la réflectivité bidirectionnelle (voir la ',
    'Add Dataset' => 'Importer un jeu de données',
    'Add Document' => 'Ajouter un document',
    'Add Document Script' => 'Ajouter un script',
    'Add Sensors' => 'Ajouter des Capteurs',
    AnnotationButtonWidget::ADD_ANNOTATION_LABEL => 'Ajouter annotation',
    'Add Vectors' => 'Ajouter des Vecteurs',
    'Address' => 'Adresse',
    'Admin' => 'Administrateur',
    'Administrative Contacts' => 'Contacts administratifs',
    'Affiliation' => 'Affiliation',
    'All Descendants' => 'Tous les Descendants',
    'Acquisition session template' => 'Gabarit de session d\'aquisition',
    'Attenuator Filter' => 'Filtre Atténuateur',
    'Available' => 'Disponible',
    'Availability' => 'Disponibilité',
    'Brand' => 'Marque',
    'BRDF coefficient P1' => 'Coefficient BRDF P1',
    'BRDF coefficient P2' => 'Coefficient BRDF P2',
    'BRDF coefficient P3' => 'Coefficient BRDF P3',
    'BRDF coefficient P4' => 'Coefficient BRDF P4',
    'Campaign' => 'Campagne',
    'Carpet' => 'Moquette',
    'Characterize Sensor' => 'Caractériser un Capteur',
    'Characterize' => 'Caractériser',
    'Circular' => 'Circulaire',
    'Column' => 'Colonne',
    'Comment' => 'Commentaire',
    'Concerns' => 'Concerne',
    'Concerned items' => ' Éléments concernés',
    'Concerned item' => 'Élément concerné',
    'Concerned item type' => 'Type de l\'élément concerné',
    'Concerned item URI' => 'URI de l\'élément concerné',
    'Concerned items URIs' => 'URIs des éléments Concernés',
    'Concerned Experimentations' => 'Expérimentations Concernées',
    'Concerned Projects' => 'Projets concernés',
    'Creation Date' => 'Date de Création',
    'Creator' => 'Auteur',
    'Crop Species' => 'Espèce',
    'Data' => 'Données',
    'Dataset' => 'Jeux de données',
    'Dataset Creation Date' => 'Données Insérées',
    'Date' => 'Date',
    'Date End' => 'Date de fin',
    'Date Of Last Calibration' => 'Date de Dernier Étalonnage',
    'Date Of Purchase' => 'Date d\'Achat',
    'Date Start' => 'Date de début',
    'Description' => 'Description',
    'Diameter' => 'Diamètre',
    'Diameter (m)' => 'Diamètre (m)',
    'Document Type' => 'Type du Document',
    'Download' => 'Télécharger',
    'Download Search Result' => 'Télécharger le Résultat de la Recherche',
    'Download Template' => 'Télécharger le Gabarit',
    'Email' => 'Adresse email',
    'Entity' => 'Entité',
    'Enter date of last calibration' => 'Saisir la date de dernier étalonnage',
    'Enter date of purchase' => 'Saisir la date d\'achat',
    'Enter in service date' => 'Saisir la date de mise en service',
    EventButtonWidget::ADD_EVENT_LABEL => 'Ajouter événement',
    EventGridViewWidget::EVENTS_LABEL => "Événements",
    EventGridViewWidget::NO_EVENT_LABEL => "Pas d'événement",
    YiiEventModel::TYPE => "Type",
    EventPost::PROPERTY_HAS_PEST_LABEL => "hasPest",
    EventPost::PROPERTY_FROM_LABEL => "depuis",
    EventPost::PROPERTY_TO_LABEL => "jusqu'à",
    EventPost::PROPERTY_TYPE_LABEL => "Type de la propriété",
    'Error' => 'Erreur',
    'Experimental Organization' => 'Organisation expérimentale',
    'Experiment Modalities' => 'Modalités Expérimentales',
    'File Extension' => 'Extension du Fichier',
    'Family Name' => 'Nom',
    'Field' => 'Champ',
    'File' => 'Fichier',
    'File Informations' => 'Informations sur le Fichier',
    'File Path' => 'Chemin du Fichier',
    'First Name' => 'Prénom',
    'Financial Name' => 'Nom du financeur',
    'Financial Support' => 'Support financier',
    'Focal Length' => 'Distance Focale',
    'Height' => 'Hauteur',
    'Generate Layer' => 'Générer la Couche',
    'Generate Map' => 'Générer la Carte',
    'Geographic Location' => 'Localisation géographique',
    'Geometry' => 'Géométrie',
    'Groups' => 'Groupes',
    'Guest' => 'Invité',
    'Hemisphericals' => 'Hémisphériques',
    'Images Visualization' => 'Visualisation d\'Images',
    'In Service Date' => 'Date de Mise en Service',
    'Internal Label' => 'Label Interne',
    'Keywords' => 'Mots clés',
    'Labels' => 'Labels',
    'Laboratory Name' => 'Nom du laboratoire',
    'Language' => 'Langue',
    'Length' => 'Longueur',
    'Length (m)' => 'Longueur (m)',
    'Level' => 'Niveau',
    'Linked Agronomical Objects' => 'Objets Agronomiques Liés',
    'Linked Documents' => 'Documents Liés',
    AnnotationGridViewWidget::LINKED_ANNOTATIONS => "Annotations liées",
    AnnotationGridViewWidget::NO_LINKED_ANNOTATIONS => "Aucune annotation liée",
    'Line' => 'Ligne',
    'Login' => 'Connexion',
    'Logout' => 'Déconnexion',
    'Map Visualization' => 'Visualisation Cartographique',
    'Material' => 'Matière',
    'Members' => 'Membres',
    'Method' => 'Méthode',
    'Missing method.' => 'La méthode est vide.',
    'Missing trait.' => 'Le trait est vide.',
    'Missing unit.' => 'L\'unité est vide.',
    'Model' => 'Modèle',
    'Name' => 'Nom',
    'No' => 'Non',
    'No item concerned' => 'Aucun élément concerné',
    'Objective' => 'Objectif',
    'On selected plot(s)' => 'Sur les micro parcelles sélectionnées',
    'Ontologies References' => 'Références vers des Ontologies',
    'Organism' => 'Organisme',
    'Owner' => 'Propriétaire',
    
    // Property
    PropertyWidget::NO_PROPERTY_LABEL => 'Aucune propriété spécifique',
    
    'Password' => 'Mot de passe',
    'Painting' => 'Peinture',
    'Person In Charge' => 'Responsable',
    'Phenotype(s) Visualization' => 'Visualisation de phénotypes',
    'Phone' => 'Téléphone',
    'Pixel Size' => 'Taille de Pixel',
    'Place' => 'Lieux',
    'Private Access' => 'Accès Privé',
    'Project Coordinators' => 'Coordinateurs du projets',
    'Project Type' => 'Type du projet',
    'Specific properties' => 'Propriétés spécifiques',
    'Public Access' => 'Accès Public',
    'Quantitative Variable' => 'Variable Quantitative',
    'Real Number' => 'Nombre Réel', 
    'Rectangular' => 'Rectangulaire',
    'Reference URI' => 'URI de Référence',
    'Register an event' => 'Enregistrer un événement',
    'Related References' => 'Références Externes',
    'Relation' => 'Relation',
    'Relation Type' => 'Type de Relation',
    'Relation Type Labels' => 'Labels du Type de Relation',
    'Replication' => 'Répétition',
    'Scientific Contacts' => 'Contacts scientifiques',
    'Scientific Supervisors' => 'Superviseurs scientifiques',
    'Select method alias...' => 'Sélectionnez l\'alias de la méthode',
    'Select trait alias...' => 'Sélectionnez l\'alias du trait',
    'Select type...' => 'Sélectionez le type',
    'Select unit alias...' => 'Sélectionnez l\'alias de l\'unité',
    'Sensor Position' => 'Position du Capteur',
    'Sensor Profile' => 'Profil du Capteur',
    'Serial Number' => 'Numéro de Série',
    'Server File Path' => 'Lien du Fichier sur le Serveur',
    'Shape' => 'Forme',
    'Shooting Configuration' => 'Configuration de prise de vue',
    'Show Images' => 'Afficher les Images',
    'Spectral hemispheric reflectance file' => 'Fichier de réflectance hémisphérique spectrale',
    'Spectralon' => 'Spectralon',
    'Status' => 'Statut',
    'Subproject Type' => 'Type de sous projet', 
    'Subproject Of' => 'Sous-projet de',
    'Team' => 'Équipe',
    'Technical Supervisors' => 'Superviseurs techniques',
    'Timezone offset' => 'Fuseau horaire',
    'Title' => 'Titre',
    'Tools' => 'Outils',
    'Trait' => 'Trait',
    'Type' => 'Type',
    'Type Labels' => 'Type Labels',
    'Unavailable' => 'Indisponible',
    'Unit' => 'Unité',
    'Update' => 'Modifier',
    'Value' => 'Valeur',
    'Value Labels' => 'Labels de la Valeur',
    'Variable' => 'Variable',
    'Variable Label' => 'Label de la Variable',
    'Variable Definition' => 'Définition de la variable',
    'Variety' => 'Variété',
    'Verification Code' => 'Code de vérification',
    'View / Download' => 'Visualiser / Télécharger',
    'Was Generated By' => 'Généré Par',
    'Wavelength' => 'Longueur d\'onde',
    'Wavelength (nm)' => 'Longueur d\'onde (nm)',
    'Website' => 'Site web',
    'Width' => 'Largeur',
    'Width (m)' => 'Largeur (m)',
    'wikipedia page' => 'page wikipédia',
    'Yes' => 'Oui',
    YiiAnnotationModel::CREATION_DATE_LABEL => 'Date de l\'annotation',
    YiiAnnotationModel::MOTIVATED_BY_LABEL  => 'Motivée par',
    YiiAnnotationModel::TARGETS_LABEL  => 'Entités ciblées',
    'Back to sensor view' => 'Retour à la vue du capteur',
    'Sensor Data Visualization' => 'Visualisation des données du capteur',
    'Update sensors' => 'Mise à jour des capteurs',
    'Update measured variables' => 'Mise à jour des variables mesurées',
];
