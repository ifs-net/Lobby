<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schießl
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

// general
define('_LOBBY_YES',						'Ja');
define('_LOBBY_NO',							'Nein');
define('_LOBBY_BACKEND',					'Administration des Moduls "lobby"');

// Header
define('_LOBBY_MAIN',						'Startseite Administration');
define('_LOBBY_PENDING_GROUPS',				'Gruppen freischalten');
define('_LOBBY_CATEGORY_MANAGEMENT',		'Kategorien verwalten');
define('_LOBBY_SETTINGS',					'Einstellungen');
define('_LOBBY_IMPORT',						'Import');

// main
define('_LOBBY_AMDIN_TEXT',					'Willkommen auf den Administrationsseiten des Moduls. Hier können Gruppen freigeschalten werden, welche zur Bewerbung ausstehen, und alle weiteren Einstellungen lassen sich hier regeln.');
define('_LOBBY_AMDIN_PENDING_GROUPS',		'Anzahl wartender Gruppenfreischaltungen');

// import
define('_LOBBY_IMPORT_MANAGEMENT',			'Importieren verschiedener Inhalte in das Modul');
define('_LOBBY_IMPORT_USERS',				'Benutzergruppen importieren');
define('_LOBBY_IMPORT_USERS_TEXT',			'Hier können Benutzergruppen aus dem Modul Groups importiert werden. Bitte hierzu die entsprechende Groups-Gruppe wählen, dann angeben, in welche Gruppe des Gruppenmoduls die Benutzerliste integriert werden soll. Änderungen werden dann sofort ausgeführt.');
define('_LOBBY_IMPORT_FORUMS',				'Foreninhalte importieren');
define('_LOBBY_IMPORT_FORUMS_TEXT',			'Hier können aus Dizkus-Foren Inhalte eingelesen und kopiert werden. Wichtig ist, dass das neue Forum, in welches Inhalte eingelesen werden sollen, eistiert. Einfach Dizus-Forum und dann Zielforum wählen und die Beiträge werden sofort eingelesen.');
define('_LOBBY_COPY_FROM',					'Kopiere von');
define('_LOBBY_COPY_TO',					'nach');
define('_LOBBY_SELECT_FOR_ACTION',			'auswählen für Import');
define('_LOBBY_NO_IMPORT_SELECTED',			'Kein Import ausgewählt. Ziel und Ausgangsgruppe /-forum muss jeweils gewählt werden!');
define('_LOBBY_IMPORT_SKIP_USER',			'Überspringe Benutzer, da bereits Mitglied in Zielgruppe');
define('_LOBBY_ADDED_USER',					'Füge Benutzer ein');
define('_LOBBY_IMPORTED_USERS',				'Erfolgreich importierte Benutzer');
define('_LOBBY_FAILED_USER',				'Fehler beim importieren von Benutzer');
define('_LOBBY_TOPIC_IMPORT_ERROR',			'Fehler beim Importieren eines Topics');
define('_LOBBY_TOPIC_IMPORTED',				'Thema importiert');
define('_LOBBY_POSTING_IMPORT_ERROR',		'Beim Importieren der zum Thema gehörenden Postings ist ein Fehler aufgetreten');

// categories
define('_LOBBY_CATEGORY_OFFICIAL',			'Offizielle Kategorie');
define('_LOBBY_CATEGORY_MANAGEMENT',		'Kategorien bearbeiten');
define('_LOBBY_CATEGORY_TITLE',				'Titel der Kategorie');
define('_LOBBY_CATEGORY_UPDATE_STORE',		'Speichern / aktualisieren');
define('_LOBBY_CATEGORY_INSERTED',			'Kategorie wurde hinzugefügt');
define('_LOBBY_CATEGORY_STOREFAILURE',		'Beim Speichern der Kategorie ist ein Fehler aufgetreten');
define('_LOBBY_CATEGORY_UPDATED',			'Kategorie wurde aktualisiert');
define('_LOBBY_CATEGORY_OFFICIAL_EXPL',		'Offizielle Gruppen durchlaufen einen Moderationsprozess und müssen einmalig freigeschalten werden. Nicht-Offizielle sind sofort nach Anmelden aktiv!');
define('_LOBBY_CATEGORY_NOCATECORIES',		'Es sind noch keine Kategorien angelegt');
define('_LOBBY_CATEGORY_OVERVIEW',			'Übersicht über existierende Kategorien, zum Editieren anklicken');
define('_LOBBY_CATEGORY_DELETE',			'Diese Kategorie löschen - nur möglich, wenn diese (noch) nicht verwendet wird');
define('_LOBBY_CATEGORY_DELETEERROR',		'Beim Löschen der Kategorie ist ein Fehler aufgetreten');
define('_LOBBY_CATEGORY_DELETED',			'Die Kategorie wurde gelöscht');

// pending
define('_LOBBY_PENDING_NO_PENDING',			'Keine zur Freischaltung ausstehenden Gruppen');
define('_LOBBY_GROUP_NAME',					'Bezeichnung');
define('_LOBBY_GROUP_AUTHOR',				'Gründer');
define('_LOBBY_GROUP_ DATE',				'Gründungsdatum');
define('_LOBBY_GROUP_CATEGORY',				'Kategorie');
define('_LOBBY_ACTION',						'Aktion');
define('_LOBBY_ACCEPT',						'freischalten');
define('_LOBBY_DELETE',						'löschen');
define('_LOBBY_GROUP_ACCEPTED',				'Gruppe wurde freigeschalten');
define('_LOBBY_GROUP_ACCEPTED_ERROR',		'Es ist ein Fehler beim Freischalten der Gruppe aufgetreten');

// settings
define('_LOBBY_CREATE_GROUP_URL',			'URL, auf welche beim "Gruppe erstellen"-Link weitergeleitet werden soll');
define('_LOBBY_CREATE_GROUP_URL_TEXT',		'Wird hier kein Wert eingetragen, gelangen die Benutzer beim Klick auf "neue Gruppe erstellen" sofort zum Formular dafür. Wenn eine Seite dazwischengeschalten werden soll, welche angezeigt wird, kann diese hier angegeben werden. Auf dieser Seite können dann Erklärungen etc. vorhanden sein. Es muss dazu ein Link zu folgender URL vorhanden sein, denn unter dieser URL können Benutzer Gruppen registrieren');
define('_LOBBY_SETTINGS_MANAGEMENT',		'Verwalten der Haupteinstellungen');
define('_LOBBY_TOPICS_PER_PAGE',			'Anzuzeigende Forenthemen pro Übersichtsseite');
define('_LOBBY_POSTS_PER_PAGE',				'Anzuzeigende Postings pro Übersichtsseite bei Ansicht eines Forenthemas');
define('_LOBBY_NEWS_PER_PAGE',				'News pro Seite bei Ansicht der Neuigkeiten-Übersicht');
define('_LOBBY_SETTINGS_UPDATE',			'Einstellungen speichern');
define('_LOBBBY_SETTINGS_STORED',			'Einstellungen wurden gespeichert');