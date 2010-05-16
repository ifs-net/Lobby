<?php
/**
 * @package      lobby
 * @version      $Id $
 * @author       Florian Schie�l
 * @link         http://www.ifs-net.de
 * @copyright    Copyright (C) 2009
 * @license      no public license - read license.txt in doc directory for details
 */

// general
define('_LOBBY_OCLOCK',							'Uhr');
define('_LOBBY_GO',								'los');
define('_LOBBY_YES',							'Ja');
define('_LOBBY_NO',								'Nein');
define('_LOBBY_ONLY_ADMIN_ACCESS',				'Zugriff auf die zuletzt ausgew�hlte Funktion ist nur Administratoren oder Gruppeninhabern erlaubt');
define('_LOBBY_FORUMS',							'Foren');
define('_LOBBY_FORUM',							'Forum');
define('_LOBBY_NEWS',							'Neuigkeiten');
define('_LOBBY_BY',								'von');
define('_LOBBY_HOURS',							'Stunden');
define('_LOBBY_GROUP',							'Gruppe');
define('_LOBBY_AUTHOR',							'Verfasser');
define('_LOBBY_DATE',							'Datum');
define('_LOBBY_OF',								'von');
define('_LOBBY_VISIT',							'besuchen');
define('_LOBBY_LAST',							'letzter');
define('_LOBBY_QUOTE',							'Text zitieren');
define('_LOBBY_GO_TO_TOP',						'Nach oben springen');
define('_LOBBY_EDIT',							'bearbeiten');

// main
define('_LOBBY_WELCOME',						'Willkommen in deinem Netzwerk');
define('_LOBBY_INTRO_WELCOME_TEXT',				'Auf dieser Seite siehst Du, was sich hier neues tut und getan hat. Alle Gruppen sind hier vertreten. Wen Du �brigens denkst, in deinem Bereich oder Interessensgebiet fehlt noch eine Gruppe, dann kannst Du aktiv werden und selbst eine Gruppe gr�nden');
define('_LOBBY_CREATE_GROUP',					'Eine eigene Gruppe erstellen');
define('_LOBBY_RECENT_JOINS',					'Neue Mitglieder in allen Gruppen');
define('_LOBBY_NEW_GROUPS',						'Neue gegr�ndete Gruppen');
define('_LOBBY_ALL_GROUPS_NEWS',				'Neuigkeiten aus allen Gruppen');
define('_LOBBY_MY_GROUPS_NEWS',					'Neuigkeiten aus meinen Gruppen');
define('_LOBBY_ALL_GROUPS_POSTS',				'Themen aus allen Gruppen');
define('_LOBBY_MY_GROUPS_POSTS',				'Themen aus meinen Gruppen');
define('_LOBBY_NO_NEW_GROUPS',					'Keine neuen Gruppen gegr�ndet');
define('_LOBBY_GROUP_EDIT_INFORMATION',			'Grundeinstellungen');
define('_LOBBY_GROUP_ADMIN_SYNC',				'Gruppe synchronisieren');
define('_LOBBY_GROUP_ONLINE_MEMBERS',			'Gruppenmitglieder, welche im Moment online sind');
define('_LOBBY_OUR_PLACE',						'Hier ist die Gruppe zu Hause');
define('_LOBBY_SHORT_LATEST_TOPICS',			'Nach neu gestarteten Themen sortieren');
define('_LOBBY_SHORT_LATEST_POSTINGS',			'Nach aktuellsten Antworten sortieren');
define('_LOBBY_FORUM_SHORTLINK_LATEST',			'Postings seit letzten Besuch');
define('_LOBBY_FORUM_SHORTLINK_24',				'Postings der letzten 24h');
define('_LOBBY_FORUM_SHORTLINK_WEEK',			'Postings der letzten Woche');
define('_LOBBY_FORUM_SHORTLINK_LATEST_TOPICS',	'Themen seit letzten Besuch');
define('_LOBBY_FORUM_SHORTLINK_24_TOPICS',		'Themen der letzten 24h');
define('_LOBBY_FORUM_SHORTLINK_WEEK_TOPICS',	'Themen der letzten Woche');
define('_LOBBY_SHOW_ALL_GROUPS',				'Alle Gruppen anzeigen');
define('_LOBBY_FORUM_SHORTLINK_ALL',			'Alle Foren zeigen');
define('_LOBBY_NO_TOPICS_YET',					'Noch keine Themen vorhanden');
define('_LOBBY_NO_NEW_ARTICLES',				'Noch kein Artikel vorhanden');
define('_LOBBY_GROUP_FORUM_SHORTLINKS',			'Foren-Schnellzugriff');
define('_LOBBY_YOU_NEED_HELP',					'Wenn Du Hilfe ben�tigst, dann');
define('_LOBBY_CLICK_HERE',						'hier klicken');
define('_LOBBY_GROUP_HELP',						'Wird Hilfe ben�tigt');
define('_LOBBY_NO_NEW_MEMBERS',					'Noch keine Mitgliedschaften vorhanden');
define('_LOBBY_ENTERED',						'ist beigetreten zu');
define('_LOBBY_GROUP_QUIT',						'Mitgliedschaft beenden');
define('_LOBBY_FORUMS_OVERVIEW_LINK',			'Aktuelle Diskussionen aller Gruppen');
define('_LOBBY_FORUMS_OWN_OVERVIEW_LINK',		'Aktuelle Diskussionen eigener Gruppen');

// forums
define('_LOBBY_DISPLAY_MODE',					'Beitr�ge filtern / anzeigen');
define('_LOBBY_SHOW_ALL',						'aus allen Gruppen');
define('_LOBBY_SHOW_ALL_OFFICIAL',				'aus allen offiziellen Gruppen');
define('_LOBBY_SHOW_OWN',						'nur eigene Gruppen');

// list
define('_LOBBY_GROUPS_LIST',					'Verf�gbare Gruppen');
define('_LOBBY_GROUPS_LIST_TEXT',				'Hier sind nun die verf�gbaren Gruppen angezeigt. In Klammer dahinter ist jeweils die Kategorie, welcher die Gruppe zugeordnet ist. Soll nach einer Kategorie gefiltert werden und andere Kategorien ausgeblendet werden - klicke einfach den Namen der Kategorie an.');
define('_LOBBY_QUICKDATA',						'Daten zur Gruppe');
define('_LOBBY_MEMBERS',						'Mitglieder');
define('_LOBBY_VISIT_GROUP',					'Gruppe besuchen');
define('_LOBBY_CAT_FILTER_HINT',				'Durch das Anklicken einer bestimmten Kategorie werden nur noch Gruppen eben dieser Kategorie angezeigt. Um wieder alle Gruppen ansehen zu k�nnen, m�ssen Sie den Filter deaktivieren');
define('_LOBBY_CAT_FILTER_DEACTIVATE',			'Filter deaktivieren');
define('_LOBBY_OPTIONS',						'Optionen');

// invite
define('_LOBBY_UNAME_NOT_FOUND',				'Benutzername konnte nicht gefunden werden - bitte Schreibweise pr�fen, eventuell hast Du dich vertippt?');
define('_LOBBY_USER_INVITED',					'Benutzer wirde zur Gruppe eingeladen');
define('_LOBBY_USER_ALREADY_MEMBER',			'Benutzer ist bereits Mitglied der Gruppe');
define('_LOBBY_USER_INVITATION_ERROR',			'Der Benutzer konnte wegen eines internen Fehlers nicht eingeladen werden');
define('_LOBBY_INVITATIONS_ONLY_MEMBERS',		'Um ein andres Mitglied in eine Gruppe einladen zu k�nnen musst Du selbst Mitglied der Gruppe sein!');
define('_LOBBY_USER_ALREADY_INVITED',			'F�r den Benutzer liegt bereits eine ausgesprochene Einladung f�r diese Gruppe vor und Mehrfacheinladungen sind nicht m�glich!');

// edit
define('_LOBBY_EDIT_INDEX_POSTINGS',            'Anzahl der Themen der Foren, welche auf der Gruppenstartseite angezeigt werden sollen');
define('_LOBBY_LAT',							'Breitengrad');
define('_LOBBY_LNG',							'L�ngengrad');
define('_LOBBY_CLICK_CARD_FOR_COORDS',			'Zur automatischen �bernahme von Koordinaten einfach an gew�nschter Stelle auf die Karte klicken!');
define('_LOBBY_MODIFY_GROUUP',					'Gruppe modifizieren oder neu anlegen');
define('_LOBBY_EDIT_GROUP_TITLE',				'Name / Bezeichnung der Gruppe');
define('_LOBBY_EDIT_GROUP_NOCHANGELATER',		'Diese Eingabe kann nach dem Anlegen der Gruppe nicht mehr ge�ndert werden');
define('_LOBBY_EDIT_GROUP_DESCRIPTION',			'Beschreibung welche zur Gruppe angezeigt werden soll und f�r Mitglieder und Nichtmitglieder sichtbar ist');
define('_LOBBY_EDIT_GROUP_CATEGORY',			'Kategorie, in welche die Gruppe eingeordnet werden soll');
define('_LOBBY_EDIT_GROUP_MODERATED',			'Neuzug�nge bed�rfen einer Freischaltung');
define('_LOBBY_EDIT_UPDATE_STORE',				'Gruppe erstellen / �nderungen speichern');
define('_LOBBY_EDIT_OFFICIALGROUPSECPL',		'Gruppen, welche in eine Rubrik eingeordnet werden, die mit einem Stern gekennzeichnet sind, m�ssen vor der endg�ltigen Nutzung erst durch den Seitenbetreiber freigegeben werden.');
define('_LOBBY_GROUPS_ADDERROR',				'Fehler beim hinzuf�gen der Gruppe');
define('_LOBBY_GROUPS_ADDED',					'Gruppe "%group%" wurde hinzugef�gt');
define('_LOBBY_GROUP_PENDING',					'Hinweis: Die Gruppe muss nach dem sie angelegt wurde erst von Seitenbetreiber freigeschalten werden, bevor sie von allen Mitgliedern genutzt und eingesehen werden kann! Du erh�ltst dann eine Nachricht, wenn das geschehen ist!');
define('_LOBBY_FORUMTITLE_INTRODUCTION',		'Vorstellungsrunde');
define('_LOBBY_FORUMTITLE_INTRODUCTION_DESC',	'Hier k�nnen neue Mitglieder Hallo sagen und sich der Gruppe vorstellen - so wei� man gleich, mit wem man es zu tun hat!');
define('_LOBBY_FORUMTITLE_Q_AND_A',				'Fragen und Antworten');
define('_LOBBY_FORUMTITLE_Q_AND_A_DESC',		'Etwas unklar? Oder hast Du eine Frage? Hier kannst Du Antworten auf deine Fragen f�r die Gruppe finden oder Fragen stellen und Antworten bekommen');
define('_LOBBY_FORUMTITLE_PRIVATE',				'Internes, privates Gruppen-Forum');
define('_LOBBY_FORUMTITLE_PRIVATE_DESC',		'In diesem Forum k�nnen interne Sachen diskutiert werden welche nur f�r Gruppenmitglieder einsehbar sind');
define('_LOBBY_FORUMTITLE_TALK',				'�ffentliches Gruppenforum');
define('_LOBBY_FORUMTITLE_TALK_DESC',			'Hier diskutierte Themen k�nnen auch von Nicht-Mitgliedern beantwortet werden. Gut f�r potentielle Mitglieder, hier einmal reinzuschnuppern!');
define('_LOBBY_GROUP_EDIT_INITPROCESS',			'Die Standardeinstellungen f�r neue Gruppen werden nun �bernommen und abgearbeitet');
define('_LOBBY_GROUP_OWNER_NODELETE',			'Der Gr�nder einer Gruppe kann nicht als Moderator oder Mitglied gel�scht werden!');
define('_LOBBY_GROUP_ALREADY_EXISTS',			'Eine Gruppe mit diesem Namen existiert bereits');
define('_LOBBY_CREATE_FORUMS',					'Standard-Foren-Landschaft gleich mit erstellen');
define('_LOBBY_DELETE_GROUP',					'Gruppe mit allen Inhalten, Gruppenzugeh�rigkeiten und Newsartikeln sowie Foren unwiderruflich und ohne weitere Sicherheitsabfrage komplett l�schen');
define('_LOBBY_DELETION_MEMBER_FAILS',			'Beim L�schen der Mitglieder ist ein Fehler aufgetreten');
define('_LOBBY_DELETION_NEWS_FAILS',			'Beim L�schen der News zur Gruppe ist ein Fehler aufgetreten!');
define('_LOBBY_DELETION_MODERATORS_FAILS',		'Beim L�schen der Moderatoren ist ein Fehler aufgetreten');
define('_LOBBY_DELETION_MEMBER_PENDING_FAILS',	'Beim L�schen �ffener Mitgliedsantr�ge ist ein Fehler aufgetreten');
define('_LOBBY_DELETION_FORUMS_FAILS',			'Beim L�schen der Gruppenforen ist ein Fehler aufgetreten');
define('_LOBBY_DELETION_GROUP_FAILS',			'Beim L�schen der Gruppenkerndaten ist ein Fehler aufgetreten');
define('_LOBBY_GROUP_DELETED',					'Die Gruppe wurde vollst�ndig entfernt');
define('_LOBBY_FORUMS_VISIBLE_TO_ALL',			'Die vorhandenen Foren sollen in der �bersicht f�r alle sichtbar sein. Themen k�nnen trotzdem nur von denen gelesen werden, die die entsprechende Berechtigung haben. So kann man zum Beispiel von au�en die Aktivit�t einer Gruppe einsehen, was bei lauter versteckten Foren oft nicht m�glich ist. Eine Gruppe kann so attraktiver wirken und mehr Neuanmeldungen erzielen.');

// groups api
define('_LOBBY_GROUP_ADDMEMBER_FAILURE',		'Fehler beim Hinzuf�gen eines Mitglieds zu einer Gruppe');
define('_LOBBY_GROUPS_MEMBERADDED',				'Mitglied "%member%" wurde hinzugef�gt');
define('_LOBBY_GROUP_GETMEMBERS_PARAMFAILURE',	'Parameter f�r das Auslesen der Gruppenmitglieder fehlerhaft');
define('_LOBBY_GROUP_SYNCED',					'Gruppen wurde synchronisiert');
define('_LOBBY_GROUP_SYNC_ERROR',				'Fehler beim Synchronisieren aufgetreten');
define('_LOBBY_REALLY_DELETE',					'Soll die L�schaktion wirklich ausgef�hrt werden? Bitte zum L�schen OK klicken. Das L�schen kann nicht r�ckg�ngig gemacht werden!');

// group
define('_LOBBY_GROUPINDEX',						'Startseite / �bersicht �ber neueste Aktivit�ten aller Gruppen anzeigen');
define('_LOBBY_GROUP_NOT_YET_ACCEPTED',			'Diese Gruppe ist noch nicht vom Seitenbetreiber akzeptiert worden. Das bedeutet, dass die Gruppe noch nicht �ffentlich einsehbar ist. Lediglich Administratoren und Du als Gruppengr�nder kannst die Gruppe sehen. Das soll aber nicht daran hindern, die Gruppe mit Startseite, Foren, News etc. schon einmal herzurichten, denn wenn der Seitenbetreiber die Gruppe dann frei gibt, sieht sie gleich richtig gut aus!');
define('_LOBBY_GROUP_INDEX_PAGE',				'Gruppen-Startseite');
define('_LOBBY_GROUP_NONEXISTENT',				'Die ausgew�hlte Gruppe existiert nicht oder ist noch nicht freigeschalten. Bitte sp�ter erneut versuchen.');
define('_LOBBY_GROUP_NEWS',						'Neuigkeiten');
define('_LOBBY_GROUP_NONEWS',					'Keine Neuigkeiten bis jetzt');
define('_LOBBY_GROUP_FACTS',					'Daten & Fakten');
define('_LOBBY_GROUP_LASTACTION',				'Letzte Aktivit�t');
define('_LOBBY_GROUP_MEMBERS',					'Mitglieder');
define('_LOBBY_GROUP_ARTICLES',					'Artikel (Neuigkeiten)');
define('_LOBBY_GROUP_FORUMS',					'Foren in der Gruppe');
define('_LOBBY_GROUP_TOPICS',					'Themen in den Foren');
define('_LOBBY_GROUP_POSTINGS',					'Postings in den Foren');
define('_LOBBY_GROUP_NEW_TOPICS',				'Neue Themen in den Foren');
define('_LOBBY_GROUP_NEW_POSTINGS',				'Neue Postings in den Foren');
define('_LOBBY_GROUP_CATEGORY',					'Kategoriezuordnung');
define('_LOBBY_GROUP_CREATOR',					'Gruppengr�nder');
define('_LOBBY_GROUP_MODERATORS',				'Moderatoren');
define('_LOBBY_GROUP_YOURSTATUS',				'Dein Status');
define('_LOBBY_GROUP_MEMBER',					'Mitglied');
define('_LOBBY_GROUP_NO_MEMBER',				'kein Mitglied');
define('_LOBBY_GROUP_JOIN',						'beitreten');
define('_LOBBY_GROUP_PUBLICGROUP',				'Beitreten: keine Freischaltung notwendig');
define('_LOBBY_GROUP_MODERATEDGROUP',			'Beitreten: Freischalten notwendig');
define('_LOBBY_GROUP_ADMIN_MENU',				'Verwaltung');
define('_LOBBY_GROUP_ADMIN_PENDING',			'Offene Mitgliedsantr�ge');
define('_LOBBY_GROUP_ADMIN_MEMBER_MANAGEMENT',	'Mitglieder verwalten');
define('_LOBBY_GROUP_ADMIN_NEW_ARTICLE',		'Newsartikel schreiben');
define('_LOBBY_GROUP_ADMIN_FORUM_MANAGEMENT',	'Foren verwalten');
define('_LOBBY_NEWS_INDEX',						'Zu allen Artikeln');
define('_LOBBY_GROUP_INVITE',					'Freunde einladen');
define('_LOBBY_GROUP_NOMEMBERS',				'Noch keine Mitglieder');
define('_LOBBY_GROUP_NOMEMBERS_ONLINE',			'Keine Mitglieder im Moment online');
define('_LOBBY_GROUP_RESPONSIBLE',				'Gruppengr�nder');
define('_LOBBY_GROUP_FORUM_INDEX',				'Foren�bersicht der Gruppe');
define('_LOBBY_GROUP_FORUM_RECENT_TOPICS',		'die neuesten Themen');
define('_LOBBY_GROUP_FORUM_RECENT_POSTS',		'die neuesten Beitr�ge');
define('_LOBBY_GROUP_TROUBLE_CONTACT',			'Im Falle von Problemen in der Gruppe bitte an den verantw. Gruppengr�nder wenden.');
define('_LOBBY_GROUP_MORE_TROUBLE_CONTACT',		'Bei schwerwiegenden Verst��en bitte die Gruppe dem Betreiber dieser Seiten melden!');
define('_LOBBY_GROUP_MODIFY_INDEX',				'Eine eigene Startseite mit Eingangsinformationen f�r die Besucher dieser Gruppe erstellen');
define('_LOBBY_GROUP_ADMIN_INDEXPAGE',			'Startseite modifizieren');
define('_LOBBY_GROUP_LATEST_MEMBERS',			'Die neuesten Mitglieder');
define('_LOBBY_GROUP_UPDATED',					'Die Gruppe wurde aktualisiert');
define('_LOBBY_GROUP_UPDATE_ERROR',				'Beim Aktualisieren der Gruppendaten ist ein Fehler aufgetreten');

// group // invite
define('_LOBBY_INVITE_ENTER_TEXT',				'Einladungstext');
define('_LOBBY_INVITE_TO_SITE',					'Personen ins Netzwerk einladen');
define('_LOBBY_INVITE_ENTER_UNAME',				'Benutzername eingeben');
define('_LOBBY_INVITE_NO_MEMBER',				'Hier externe einladen');

// group // quit
define('_LOBBY_QUIT_MEMBERSHIP',				'Beenden der Mitgliedschaft in');
define('_LOBBY_QUIT_MEMBERSHIP_TEXT',			'Durch das Beenden deiner Mitgliedschaft in der Gruppe wirst Du von der Mitgliederliste genommen. Um neu in die Gruppe zu gelangen musst Du dich wieder neu bewerben und ggf. vom Gruppengr�nder f�r die Gruppe neu freigeschalten werden. Die Abmeldung aus der Gruppe wird unverz�glich ausgef�hrt und der Gruppenbesitzer wird dar�ber per Email informiert.');
define('_LOBBY_QUIT_MEMBERSHIP_LINK',			'Hier klicken um sofort die Mitgliedschaft zu beenden');
define('_LOBBY_MEMBERSHIP_QUITTED',				'Mitgliedschaft der wurde gek�ndigt und aufgehoben');
define('_LOBBY_MEMBERSHIP_QUIT_REASON',			'Wenn Du dem Gruppengr�nder den Grund der K�ndigung der Mitgliedschaft mitteilen willst, kannst Du folgendes Textfeld nutzen');

// group // forums
define('_LOBBY_GROUP_NO_FORUM',					'In dieser Gruppe gibt es aktuell kein Forum');
define('_LOBBY_FORUM_TOPICS',					'Themen');
define('_LOBBY_FORUM_POSTS',					'Beitr�ge');
define('_LOBBY_FORUM_LATES_TOPIC',				'Neuestes Thema');
define('_LOBBY_FORUM_LATES_POST',				'Letzter Beitrag');
define('_LOBBY_PUBLIC_STATUS_GROUP',			'Einsehbar und nutzbar nur f�r Gruppenmitglieder');
define('_LOBBY_PUBLIC_STATUS_REGUSERS',			'Einsehbar und nutzbar durch registrierte Benutzer');
define('_LOBBY_PUBLIC_STATUS_ALL',				'Einsehbar durch alle, nutzbar durch registrierte Benutzer');
define('_LOBBY_SINCE_DATE',						'seit dem Datum');
define('_LOBBY_SINCE',							'seit');
define('_LOBBY_TOPICS_SHOW',					'anzeigen');
//define('_LOBBY_FORUM_TOPICS_OF_LAST',			'Themen der letzten');
define('_LOBBY_LATEST_POSTS',					'Die neuesten Forenbeitr�ge');
define('_LOBBY_LATEST_TOPICS',					'Die neuesten Forenthemen');

// group // join
define('_LOBBY_GROUP_JOINGROUP',				'Dieser Gruppe beitreten');
define('_LOBBY_GROUP_JOIN_MODERATED',			'Diese Gruppe ist moderiert, was heisst, dass der Gruppe nicht direkt beigetreten werden kann und f�r den Beitritt die Erlaubnis des Gruppeninhabers erforderlich ist. Deiner Anmeldung f�r die Gruppe kannst Du einen Text hinzuf�gen, welcher dem Verantwortlichen dann angezeigt wird.');
define('_LOBBY_GROUP_JOIN_TEXT',				'Information f�r den Gruppenadministrator f�r deine Aufnahme in die Gruppe');
define('_LOBBY_GROUP_JOIN_NOW',					'Der Gruppe sofort beitreten');
define('_LOBBY_GROUP_JOIN_REQUEST',				'Antrag auf Gruppenmitgliedschaft senden');
define('_LOBBY_GROUP_JOIN_PUBLIC',				'Mit dem Klick auf "Gruppe beitreten" ist die Mitgliedschaft sofort aktiv.');
define('_LOBBY_GROUP_REQUESTSENT',				'Anfrage auf Mitgliedschaft wurde abgeschickt und ist in Bearbeitung');
define('_LOBBY_GROUP_JOINERROR',				'Ein Fehler ist aufgetreten beim stellen der Beitrittsanfrage');
define('_LOBBY_GROUP_ADD_ALREDY_MEMBER',		'Du bist bereits Mitglied dieser Gruppe');
define('_LOBBY_GROUP_ADD_ALREDY_PENDING',		'Ein Aufnahmeantrag f�r die Gruppe ist bereits gestellt - bitte warte das Ergebnis ab!');
define('_LOBBY_GROUPS_ADDERROR',				'Das endg�ltige Hinzufugen zu einer Gruppe wurde mit einem Fehler abgebrochen!');

// groups // pending
define('_LOBBY_GROUP_PENDING_MEMBERS',			'Auf Freischaltung wartende Personen');
define('_LOBBY_GROUP_PENDING_TEXT',				'Die hier nun aufgef�hrten Personen haben sich f�r diese Gruppe als Mitglied beworben. Bei der Anmeldung zur Gruppe kann ein Text zur Verbindungsaufnahme ausgef�llt werden, welcher dann hier mit angezeigt wird. Solange durch den Gruppenadministrator keine Aktion erfolgt, �ndert sich der Status nicht. Bitte entscheide baldm�glichst, was mit den Personen geschehen soll, damit diese nicht zu lange im Ungewissen gehalten werden. Die Ausgabe der Personen ist nach Datum sortiert - �ltere Anfragen erscheinen ganz oben.');
define('_LOBBY_GROUP_NO_PENDING',				'Es warten aktuell keine Mitglieder auf Freischaltung');
define('_LOBBY_GROUP_PENDING_ACCEPT',			'akzeptieren');
define('_LOBBY_GROUP_PENDING_DENY',				'ablehnen');
define('_LOBBY_GROUP_PENDING_ACCEPT_ERROR',		'Beim hinzuf�gen des Mitglieds ist ein Fehler aufgetreten');


// group // article
define('_LOBBY_NEWS_ADDARTICLE',				'Artikel schreiben oder bearbeiten');
define('_LOBBY_NEWS_EXPLANATION',				'Hier k�nnen News-Artikel geschrieben werden. Je nachdem, wie die Sichtbarkeit dann von Dir ausgew�hlt wird, ist der Artikel so nur in der Gruppe, nur f�r alle Mitglieder dieser Seite oder auch f�r alle G�ste sichtbar. Dies kann je nach Artikel individuell geregelt werden.');
define('_LOBBY_NEWS_TITLE',						'Titelzeile des Artikels');
define('_LOBBY_NEWS_TEXT',						'Inhalt des Artikels');
define('_LOBBY_NEWS_STORE_UPDATE',				'Artikel speichern bzw. aktualisieren');
define('_LOBBY_NEWS_PUBLIC_STATUS',				'Dieser Artikel soll f�r folgende Gruppe lesbar sein');
define('_LOBBY_ALL',							'Alle Benutzer dieser Seite inklusive G�ste');
define('_LOBBY_GROUPMEMBERS',					'Nur f�r Mitglieder dieser Gruppe');
define('_LOBBY_SITEMEMBERS',					'F�r registrierte Mitglieder dieser Seite und Mitglieder dieser Gruppe');
define('_LOBBY_NEWS_DELETE_ARTICLE',			'Diesen Artikel unwiderruflich l�schen');
define('_LOBBY_NEWS_DATE',						'Datum und Zeit des Artikels');
define('_LOBBY_NEWS_DATE_EXPLANATION',			'Artikel mit Datum in der Zukunft werden erst nach Erreichen des Datums angezeigt und Artikel, welche in die Vergangenheit zur�ckdatiert werden, werden auch entsprechend eingeordnet');
define('_LOBBY_NEWS_PREVIEW_ARTICLE',			'Vorschau-Modus: Nur Vorschau, kein Speichern');
define('_LOBBY_NEWS_ARTICLEPREVIEW',			'Der Artikel wurde noch nicht gespeichert und nur zum Ansehen der Vorschau erzeugt. Zum Verlassen des Vorschau-Modus bitte das H�kchen bei "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" wieder entfernen!');
define('_LOBBY_FORUM_PREVIEW',					'Dies ist eine Vorschau f�r das Forenthema. Bitte, wenn das Bearbeiten abgeschlossen ist, das H�kchen bei "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" entfernen und abschicken.');
define('_LOBBY_NEWS_PREVIEW',					'Erzeugte Vorschau f�r den Artikel');
define('_LOBBY_NEWS_WRITTENBY',					'Autor');
define('_LOBBY_NEWS_CREATED',					'Artikel wurde erstellt');
define('_LOBBY_NEWS_CREATIONERROR',				'Beim Erstellen des Artikels ist ein Fehler aufgetreten');
define('_LOBBY_NEWS_EDIT',						'Artikel editieren');
define('_LOBBY_ARTICLE_PREVIEW',				'Beitragsvorschau');
define('_LOBBY_NEWS_UPDATED',					'Der Artikel wurde aktualisiert');
define('_LOBBY_NEWS_UPDATEERROR',				'Beim Aktualisieren des Artikels ist ein Fehler aufgetreten!');
define('_LOBBY_NEWS_DELETED',					'Artikel wurde gel�scht');

//group // news
define('_LOBBY_NEWS_PUBLICSTATUS_TEXT',			'Als Nichtmitglied einer Gruppe oder als nicht registrierter Benutzer sehen sie nur die Artikel der Gruppe ein, welche hierf�r freigegeben sind. Wenn Du bei der Gruppe Mitglied wirst bzw. Dich bei dieser Seite anmeldest, hast Du Zugriff auf deutlich mehr Informationen als jetzt.');
define('_LOBBY_NEWS_INFUTURE',					'Das Datum dieses Artikels liegt in der Zukunft - dieser Artikel ist damit nur f�r den Autor einsehbar');
define('_LOBBY_NEWS_NOAUTH_NOCONTENT',			'Der Artikel existiert nicht oder Du hast nicht die notwendigen Rechte, diesen Artikel einzusehen. Melde Dich bei diesen Seiten an, um den Zugriff auf die Inhalte auszuweiten');
define('_LOBBY_NEWS_SEND_TO_GROUP',				'Artikel per Mail an Gruppe schicken');
define('_LOBBY_ARTICLE_SENT_TO_GROUP',			'Der Artikel wurde an alle Mitglieder der Gruppe geschickt');
define('_LOBBY_ARTICLE_SENT_ERROR',				'Der Artikel konnte nicht verschickt werden - Der Versand wurde abgebrochen');
define('_LOBBY_GROUP_NEWS_FROM',				'Gruppen-News der Gruppe');
define('_LOBBY_NEWS_MAIL_FOOTER',				'Dieses Email wurde aufgrund der Gruppenmitgliedschaft zu obiger Gruppe bei '.pnGetBaseURL().' verschickt. Bei Fragen wende Dich bitte an den Gruppenverantwortlichen / Gruppengr�nder, welcher diesen Versand veranlasst hat.');
define('_LOBBY_DEAR',							'Lieber Benutzer');
define('_LOBBY_GROUP_NEWS_RELEASED',			'in einer Gruppe, in welcher Du Mitglied bist, wurden News ver�ffentlicht. Diese hat der Gruppenverantwortliche gleich allen Mitgliedern per Email zustellen lassen, so dass Du schnell auf dem Laufenden gehalten wirst!');
define('_LOBBY_GROUP_LINK',						'Link zur Gruppe');
define('_TRACKING_ARTICLE_SENT_ALREADY',		'Ein Artikel kann nur einmal per Email an alle geschickt werden - Mehrfachsendung nicht m�glich!');

// group // membermanagement
define('_LOBBY_MEMBER_MANAGEMENT',				'Mitglieder-Management');
define('_LOBBY_MEMBER_MANAGEMENT_EXPLANATION',	'Hier k�nnen die Mitglieder der Gruppe bearbeitet werden. So k�nnen Mitglieder entfernt werden oder mit dem Status Moderator versehen werden. Grunds�tzlich gibt es ein sehr einfaches Rechtesystem f�r die Verwaltung. Der Gruppeninhaber darf alles, ein Moderator darf alles in den Foren der Gruppen. Artikel schreiben, Foren- und Gruppeneinstellungen �ndern ist einem Moderator jedoch nicht erlaubt. Allerdings kann er Forenbeitr�ge bearbeiten, l�schen, sperren etc. und so eine gro�e Hilfe sein. Moderatoren sollten mit Bedacht ausgew�hlt werden, denn der Gruppeninhaber tr�gt immer noch die alleinige Verantwortung f�r seine Gruppe dem Betreiber dieses Netzwerks gegen�ber.');
define('_LOBBY_MEMBER_MANAGEMENT_HOWTO',		'Um ein Mitglied hier zu bearbeiten oder seinen Status zu ver�ndern muss es zuerst aus der DropDown-List ausgew�hlt werden. Dann wird das Bearbeitungsmen� angezeigt und �nderungen, Statuswechsel oder L�schungen k�nnen vorgenommen werden.');
define('_LOBBY_MEMBER_MANAGEMENT_SELECTUSER',	'Benutzer der Gruppe ausw�hlen');
define('_LOBBY_MEMBER_MANAGEMENT_LOAD',			'Benutzer laden');
define('_LOBBY_GROUP_REJECT_MEMBER_FAILURE',	'Fehlerhafte Parameter beim Zur�ckweisen eines Antrags einer Person auf Zugang zu einer Gruppe');
define('_LOBBY_GROUP_DELETE_MEMBER_FAILURE',	'Fehler beim L�schen einer Mitgliedschaft');
define('_LOBBY_USER_NOT_A_MEMBER',				'Person ist kein Mitglied der Gruppe');
define('_LOBBY_USER_IS_OWNER',					'Person ist Gr�nder der Gruppe');
define('_LOBBY_USER_DELETED',					'Der Benutzer wurde aus der Gruppe gel�scht');

// group // membermanagement // modify
define('_LOBBY_MEMBER_MANAGEMENT_GETERROR',		'Der Benutzer konnte nicht geladen werden');
define('_LOBBY_MEMBER_MANAGEMENT_SELECTEDUSER',	'Ausgew�hlter Benutzer');
define('_LOBBY_MEMBER_MANAGEMENT_USER',			'Daten zum Mitglied');
define('_LOBBY_MEMBER_MANAGEMENT_DELETE',		'Den Benutzer aus dieser Gruppe entfernen');
define('_LOBBY_MEMBER_MANAGEMENT_APPLY',		'�nderungen anwenden');
define('_LOBBY_MEMBER_MANAGEMENT_MODERATOR',	'Benutzer ist Moderator');
define('_LOBBY_MEMBER_MANAGEMENT_NOCHANGE',		'Es wurden keine �nderungen am ausgew�hlten Benutzer vorgenommen');
define('_LOBBY_MEMBER_MANAGEMENT_BACKLINK',		'Zur�ck zur Mitgliederverwaltung');
define('_LOBBY_MEMBERSHIP_REQUEST_REJECTED',	'Der Antrag auf Mitgliedschaft wurde nun zur�ckgewiesen');
define('_LOBBY_MEMBERSHIP_REJECT_ERROR',		'Beim Zur�ckweisen des Mitgliedschaftsantrags ist ein Fehler aufgetreten');

// group // modifyindex
define('_LOBBY_INDEXPAGE_CREATED',				'Startseite wurde gespeichert');
define('_LOBBY_INDEXPAGE_CREATIONERROR',		'Fehler beim Anlegen der Startseite');
define('_LOBBY_INDEXPAGE_ARTICLEPREVIEW',		'Die Seite wurde noch nicht gespeichert und nur zum Ansehen der Vorschau erzeugt. Zum Verlassen des Vorschau-Modus bitte das H�kchen bei "'._LOBBY_NEWS_PREVIEW_ARTICLE.'" wieder entfernen!');
define('_LOBBY_INDEXPAGE_PREVIEW',				'Vorschau des aktuellen Bearbeitungsstands');
define('_LOBBY_INDEXPAGE_EXPLANATION',			'Du kannst eine kleine Startseite erstellen, welche �ber den neuesten Forenthemen und Antworten und Mitgliedern angezeigt wird. Sie sollte nicht mit Informationen �berladen sein und andere interessiert an dieser Gruppe machen.');
define('_LOBBY_INDEXPAGE_STORE_UPDATE',			'Seite speichern / aktualisieren');
define('_LOBBY_INDEXPAGE_TEXT',					'Inhalt, welcher auf der Startseite eingebunden werden soll');

// group // forummanagement
define('_LOBBY_FORUM_MANAGEMENT',				'Verwaltung der Gruppenforen');
define('_LOBBY_FORUM_MANAGEMENT_EXPLANATION',	'Hier k�nnen vorhandene Foren verwaltet und editiert werden und neue Foren angelegt werden. Wichtig ist vor allem die Sichtbarkeit der Foren. Manches sollen nur Mitglieder lesen k�nnen, manches k�nnen alle lesen k�nnen. Die Einstellungen k�nnen jederzeit beliebig editiert und abge�ndert werden. Man sollte jedoch vorsichtig sein, wenn man ein Forum in der Sichtbarkeits-Stufe �ndert und Inhalte pl�tzlich allen zug�nglich sind und Mitglieder dort Sachen gepostet haben, die sie nicht allen zug�nglich haben wollen.');
define('_LOBBY_FORUM_ADD_NEW_FORUM',			'Neues Forum hinzuf�gen');
define('_LOBBY_FORUM_EXISTING_FORUMS',			'Vorhandene Gruppen-Foren');
define('_LOBBY_FORUM_TITLE',					'Foren-Titel');
define('_LOBBY_FORUM_DESCRIPTION',				'Beschreibungstext f�r das Forum');
define('_LOBBY_FORUM_PUBLIC_STATUS',			'Inhalt des Forums soll einsehbar bzw. nutzbar sein f�r');
define('_LOBBY_FORUM_STORE_UPDATE',				'Forum anlegen / aktualisieren');
define('_LOBBY_FORUM_CREATED',					'Das Forum "%forum%" wurde erfolgreich angelegt');
define('_LOBBY_FORUM_SYNC_HINT',				'Bitte verwende die Funktion "synchronisieren", wenn Beitragsz�hler oder Benutzernamen bei Postings nicht stimmen sollten oder Darstellungsfehler auftreten. Diese Funktion kann manche Probleme beheben.');
define('_LOBBY_FORUM_CREATION_ERROR',			'Beim Erstellen eines Forums ist ein Fehler aufgetreten');
define('_LOBBY_FORUM_NOFORUMS',					'Noch keine Foren angelegt');
define('_LOBBY_FORUM_UPDATED',					'Einstellungen des Forums wurden aktualisiert');
define('_LOBBY_FORUM_UPDATE_ERROR',				'Beim Speichern der Einstellungen zum Forum ist ein Fehler aufgetreten');
define('_LOBBY_FORUM_DELETED',					'Das Forum wurde gel�scht');
define('_LOBBY_FORUM_DELETE_ERROR',				'Beim L�schen des Forums ist ein Fehler aufgetreten');
define('_LOBBY_FORUM_DELETE',					'Forum mit allen Inhalten unwiderruflich, sofort und ohne Nachfrage komplett l�schen');
define('_LOBBY_FORUM_WRITABLE_HINT',			'Wenn ein Forum f�r G�ste oder registrierte Mitglieder freigegeben ist, k�nnen diese auch Beitr�ge in den Foren verfassen. Nur wenn das Forum ausschlie�lich f�r die Gruppe eingerichtet wird ist es nur f�r Gruppenmitglieder einsehbar und beschreibbar.');
define('_LOBBY_FORUM_CLICK_TO_EDIT',			'Um ein Forum zu bearbeiten, bitte in der Tabellenzeile des Forums den Link "bearbeiten" anklicken. ');
define('_LOBBY_SYNC_FORUM',						'synchronisieren');
define('_LOBBY_TOPICS_SYNCED_IN',				'Themen wurden synchronisiert in');
define('_LOBBY_FORUM_PERMISSIONS',				'Zugriffsschutz');
define('_LOBBY_FORUM_POS',						'Position');
define('_LOBBY_MOVE_UP',						'Forum nach oben schieben');
define('_LOBBY_MOVE_DOWN',						'Forum nach unten schieben');
define('_LOBBY_FORUM_ACTION',					'Aktion');
define('_LOBBY_STATUS_PUBLIC',					'G�ste: lesen, Nutzer: schreiben, Mitglieder: schreiben');
define('_LOBBY_STATUS_MEMBERS',					'G�ste: kein, Nutzer: schreiben, Mitglieder: schreiben');
define('_LOBBY_STATUS_PRIVATE',					'G�ste: kein, Nutzer: kein, Mitglieder: schreiben');

// forumtopics api
define('_LOBBY_TOPICSAPI_ADD_PARAMERROR',		'Parameter falsch �bergeben f�r Funktion Thema erstellen');
define('_LOBBY_TOPIC_CREATION_ERROR',			'Das Thema konnte nicht erstellt werden');

// moderators api
define('_LOBBY_GROUP_GETMODERATORS_PARAMFAILURE','Falsche oder fehlende Parameter beim Auslesen der Moderatoren');
define('_LOBBY_GROUP_ADDMODERATOR_FAILURE',		'Fehlerhafte Parameter beim Hinzuf�gen eines neuen Moderators zu einer Gruppe');
define('_LOBBY_GROUP_MODERATORS_ACCESS_DENY',	'Keine Rechte um einen Moderator zu dieser Gruppe hinzuzuf�gen oder zu entfernen');
define('_LOBBY_GROUPS_MODERATORADDERRO',		'Fehler beim Hinzuf�gen eines neuen Moderators zur Gruppe');
define('_LOBBY_GROUPS_MODERATORADDED',			'Benutzer "%user%" wurde als Moderator hinzugef�gt');
define('_LOBBY_GROUPS_ALREADY_MOD',				'Der Benutzer ist bereits Moderator');
define('_LOBBY_GROUP_DELMODERATOR_FAILURE',		'Fehlerhafte oder falsche Parameter beim L�schen eines Moderators aus einer Gruppe');
define('_LOBBY_GROUP_WAS_NO_MODERATOR',			'Der Benutzer war kein Moderator und kann daher nicht als Moderator gel�scht werden');
define('_LOBBY_GROUPS_MODERATORREMOVED',		'Moderatorenrechte wurden entzogen');
define('_LOBBY_GROUPS_MODERATORDELERROR',		'Beim Entziehen der Moderatorenrechte ist ein Fehler aufgetreten');

// group // forum
define('_LOBBY_CFORUM_SUBSCRIBED',				'Forenabo existent');
define('_LOBBY_FORUM_INDEX',					'Foren�bersicht');
define('_LOBBY_FORUM_PUBLICSTATUS_TEXT',		'Wenn Du kein Mitglied dieser Gruppe bist hast Du nur sehr eingeschr�nkten Zugriff auf die Inhalte dieser Gruppe.  Meist sind Foren f�r nicht registrierte Benutzer generell nicht sichtbar geschalten und auch f�r Mitglieder des Netzwerks ist viel nicht zug�nglich. Wenn Du an der Gruppe Interesse hast, werde Mitglied und gelange so an alle wichtigen Informationen.');
define('_LOBBY_NEW_TOPIC',						'Neues Thema erstellen');
define('_LOBBY_FORUM_NOPOSTS',					'Noch keine Themen vorhanden oder Zugriff auf Themen nicht erlaubt');
define('_LOBBY_FORUM_TOPIC_TITLE',				'Titel des Themas');
define('_LOBBY_FORUM_TOPIC_LASTDATE',			'Datum');
define('_LOBBY_FORUM_TOPIC_EXPLANATION',		'Hier kannst Du ein neues Foren-Thema beginnen. Das Thema wird nach Abschicken dann ganz oben auf der Liste angezeigt und andere Mitglieder k�nnen darauf antworten. Bitte gib Dir M�he beim Schreiben, denn Du willst ja auch, dass andere Leute deinen Text einfach und schnell lesen k�nnen. Gerne kannst Du daf�r die Vorschaufunktion nutzen. Behalte bitte in Diskussionen auch den guten Umgangston bei, den wir von Dir gewohnt sind! Viel Spa�...');
define('_LOBBY_FORUM_TOPIC_REPLIES',			'Antworten');
define('_LOBBY_NEW_REPLY',						'Antwort zu diesem Thema verfassen');
define('_LOBBY_FORUM_REPLY_EXPLANATION',		'Hier kannst Du nun eine Antwort zum diskutierten Thema machen. Auch wenn manche Diskussion hitzig werden kann: bedenke, dass am anderen Ende der Internets auch ein Mensch sitzt. Aber da guter Umgangston f�r Dich selbstverst�ndlich ist, brauchen wir hier auch nichts weiter schreiben. Die Antwort wird dann am Ende des Antwort-Baums hinzugef�gt und vorherige Autoren werden meist zudem per Email �ber Deine Nachricht informiert. Um einen sch�nen Beitrag zu verfassen, kannst Du nat�rlich die Vorschaufunktion nutzen, bevor die Antwort endg�ltig gespeichert wird.');
define('_LOBBY_FORUM_REPLY_PREFIX',				'Antwort');
define('_LOBBY_REPLY_POSTED',					'Die Antwort wurde gespeichert');
define('_LOBBY_FORUM_NO_POST_AUTH',				'Ein neues Thema oder eine Antwort zu den Themen k�nnen nur Gruppenmitglieder erstellen. Vielleicht ein Grund, der Gruppe beizutreten?');
define('_LOBBY_FORUM_STORE_REPLY',				'Antwort speichern');
define('_LOBBY_NO_FORUM_SELECTED',				'Es wurde kein g�ltiges Forum ausgew�hlt');
define('_LOBBY_FORUM_NOT_SUBSCRIBED',			'kein Abo');
define('_LOBBY_FORUM_SUBSCRIBED',				'im Abo');
define('_LOBBY_FORUM_SUBSCRIBE',				'abonnieren');
define('_LOBBY_FORUM_SUBSCRIBED_NOW',			'Forum nun im Abo');
define('_LOBBY_FORUM_SUBSCRIBE_ERROR',			'Bei Versuch das Forum zu abonnieren ist ein Fehler aufgetreten');
define('_LOBBY_FORUM_ALREADY_SUBSCRIBED',		'Das Forum ist bereits im Abonnement');
define('_LOBBY_FORUM_UNSUBSCRIBE',				'Abo l�schen');
define('_LOBBY_FORUM_UNSUBSCRIBED_NOW',			'Das Foren-Abonnement wurde gel�scht');
define('_LOBBY_FORUM_UNSUBSCRIBE_ERROR',		'Das Abonnement des Forums konnte nicht gel�scht werden - es ist ein Fehler aufgetreten');
define('_LOBBY_TOPIC_SUBSCRIBED_NOW',			'Das Thema ist nun abonniert');
define('_LOBBY_TOPIC_SUBSCRIBE_ERROR',			'Beim Abonnieren des Themas ist ein Fehler aufgetreten');
define('_LOBBY_TOPIC_ALREADY_SUBSCRIBED',		'Das Thema ist bereits abonniert');
define('_LOBBY_TOPIC_UNSUBSCRIBED_NOW',			'Das Themen-Abonnement wurde gel�scht');
define('_LOBBY_TOPIC_UNSUBSCRIBE_ERROR',		'Beim L�schen des Themen-Abonnements ist ein Fehler aufgetreten');
define('_LOBBY_POSTING_TITLE',					'Titel des Themas');
define('_LOBBY_FORUM_STORE',					'Thema speichern');
define('_LOBBY_FORUM_JUST_PREVIEW',				'Vorschaumodus aktivieren');
define('_LOBBY_POSTING_CONTENT',				'Inhalt des Themas');
define('_LOBBY_TOPIC_CREATED',					'Forenthema wurde erstellt');
define('_LOBBY_TOPIC_CREATION_ERROR',			'Beim Versuch das Thema anzulegen ist ein Fehler aufgetreten');
define('_LOBBY_FORUM_CONTAINS',					'Das Forum enth�lt');
define('_LOBBY_TOPICS_AND',						'Themen und insgesamt');
define('_LOBBY_POSTS',							'Beitr�ge');
define('_LOBBY_MODERATOR_ACTIONS',				'Moderationsm�glichkeiten');
define('_LOBBY_TOPIC_DELETE',					'Thema l�schen');
define('_LOBBY_TOPIC_CLOSE',					'Thema schlie�en');
define('_LOBBY_TOPIC_REOPEN',					'Thema wieder er�ffnen');
define('_LOBBY_TOPIC_MARK',						'Thema markieren');
define('_LOBBY_TOPIC_UNMARK',					'Themenmarkierung entfernen');
define('_LOBBY_TOPIC_MOVE',						'Thema verschieben');
define('_LOBBY_TOPIC_UPDATE_FAILED',			'Das aktualisieren des Themas ist fehlgeschlagen');
define('_LOBBY_MODERATION_TOPIC_DELETED',		'Das Thema wurde gel�scht');
define('_LOBBY_EDIT_NOTPOSSIBLE',				'Das Editieren des Themas ist nicht mehr m�glich. Themen k�nnen nur so lange bearbeitet werden, bis eine Antwort auf dieses verfasst wurde und Antworten k�nnen nur so lange editiert werden, bis weitere Antworten geschrieben wurden. Dies dient alleine dazu, Diskussionen im Nachhinein nicht verf�lschbar zu machen. Wenn dringend etwas ver�ndert werden muss, wende Dich bitte an einen Moderator der Gruppe.');
define('_LOBBY_MODERATION_TOPIC_UNMARKED',		'Die Markierung des Themas wurde zur�ckgenommen');
define('_LOBBY_MODERATION_TOPIC_MARKED',		'Das Thema wurde markiert');
define('_LOBBY_MODERATION_TOPIC_REOPENED',		'Das Thema wurde wieder er�ffnet');
define('_LOBBY_MODERATION_TOPIC_CLOSED',		'Das Thema wurde abgeschlossen');
define('_LOBBY_FORUM_TOPIC_LOCKED',				'Dieses Thema wurde von einem Moderator geschlossen - das Erstellen von weiteren Antworten ist daher nicht mehr m�glich');
define('_LOBBY_ILLEGAL_MODERATOR_ACTION',		'Du hast keine Moderatorenrechte. Finger weg von Moderatorenfunktionen!');
define('_LOBBY_MODERATOR_DELETE_POSTING',		'Diesen Beitrag l�schen');
define('_LOBBY_MODERATION_POSTING_DELETED',		'Der Beitrag wurde gel�scht');
define('_LOBBY_FORUM_INSTANT_ABO',				'Das Thema gleich abonnieren, falls noch nicht geschehen');
define('_LOBBY_FORUM_POSTING_INFO',				'Informationen');
define('_LOBBY_FORUM_TOPICS_LAST_VISIT',		'Themen seit der letzten Nutzung anzeigen');
define('_LOBBY_FORUM_POSTINGS_LAST_VISIT',		'Beitr�ge seit der letzten Nutzung anzeigen');
define('_LOBBY_FORUM_LATEST_POSTING',			'Neuesten Beitrag anzeigen');
define('_LOBBY_RESET_LAST_VISIT',				'zur�cksetzen');
define('_LOBBY_MODERATOR_EDIT_POSTING',			'Beitrag bearbeiten');
define('_LOBBY_FORUM_EDIT_HINT',				'Beitr�ge k�nnen bearbeitet werden - aber dies nicht unbegrenzt lange. Im Nachhinein ver�nderte Beitr�ge k�nnen eine Diskussion abf�lschen und in falschem Licht erscheinen lassen. Sobald jemand auf deinen Beitrag geantwortet hat oder schon jemand nach Dir eine andere Antwort zum Thema abgegeben hat, ist ein Bearbeiten ausgeschlossen und nur noch durch Moderatoren m�glich.');
define('_LOBBY_LAST_EDITED',					'Beitrag wurde editiert; zuletzt am');
define('_LOBBY_POST_MODIFIED',					'Beitrag wurde abge�ndert');
define('_LOBBY_MOVE_TOPIC_TO',					'Thema verschieben in Forum');
define('_LOBBY_MODERATION_HOTTOPIC',			'Dieses Thema ist ein viel disktuertes Thema');
define('_LOBBY_POST_MODIFY_ERROR',				'Fehler beim An�ndern des Beitrags aufgetreten');
define('_LOBBY_TOPIC_MOVED',					'Thema wurde verschoben');
define('_LOBBY_NO_EDIT_PERMISSION',				'Keine Berechtigung, diesen Beitrag zu editieren');
define('_LOBBY_LAST_REPLY',						'letzte Antwort von');
define('_LOBBY_MARK_QUOTE',						'Bitte in dem Beitrag die Stellen mit der Maus markieren, welche zitiert werden sollen. Mehrfachzitierungen sind m�glich und werden automatisch nacheinander eingef�gt.');
define('_LOBBY_MARK_QUOTE_DONE',				'Folgender Text wurde im Antwort-Feld als Zitat hinzugef�gt. Weitere Zitate sind m�glich!');

//groups //help
define('_LOBBY_HELP_PAGE',						'Erkl�rungen und Hilfestellungen zu den Gruppen');
define('_LOBBY_HELP_INTRODUCTION',				'Hier findest Du einige Hilefstellungen rund um die Gruppenfunktionen dieser Seite. Wenn Fragen auftreten, die Du selbst nicht mit Hilfe dieses Textes beantworten kannst, frage bitte beiden Moderatoren der Gruppe oder beim Ersteller der Gruppe nach. Diese werden Dir helfen k�nnen, da sie mit diesen Funktionen hier vertraut sind. Sofern das nicht Hilft, kannst Du dich an den Support dieser Seite wenden. Beachte aber, dass eine Antwort unter Umst�nden nicht sofort bearbeitet werden kann und die Bearbeitung einige Werktage ben�tigt.');
define('_LOBBY_HELP_GENERAL',					'Generelles zu den Gruppen');
define('_LOBBY_HELP_GENERAL_TEXT',				'Mit dem Gruppenmodul ist es m�glich, eigene Gruppen einzurichten. Gruppen haben einen Titel, eine Beschreibung, verschiedene Einstellungen zum Mitgliedermanagement und die M�glichkeit, Koordinaten anzugeben. Sofern Koordinaten angegeben werden kann die Gruppe geografisch zugeordnet werden und in eine Landkarte mit eingef�gt werden. Gruppen sollen Interessensgemeinschaften m�glich machen, welche im Idealfall sich geografisch einordnen lassen. Zudem ist es optional m�glich, Gruppen in Kategorien einzuordnen. So ist eine Klassifizierung der Gruppen gew�hrleistet.');
define('_LOBBY_HELP_MEMBERSHIP',				'Mitgliedschaft in Gruppen');
define('_LOBBY_HELP_MEMBERSHIP_TEXT',			'Gruppen kann grunds�tzlich jeder beitreten. M�glicherweise bedarf der Beitritt - das ist von den Einstellungen abh�ngig, welche der Gruppengr�nder getroffen hat - der Zustimmung des Gruppengr�nders. �ber die Zustimmung wirst Du jedoch dann per Email informiert. Ebenso wird der Gruppengr�nder informiert. Du brauchst also keine Angst haben, dass dein Mitgliedschaftsantrag geh�rlos untergeht. Sofern keine gesonderte Zustimmung notwendig ist, wird man unmittelbar Mitglied der Gruppe, f�r welche man sich beworben hat.');
define('_LOBBY_HELP_GROUPRULES',				'Regeln und Ziele einer Gruppe');
define('_LOBBY_HELP_GROUPRULES_TEXT',			'Die Regeln in einer Gruppe h�ngen von Ziel und Gr�nder der Gruppe ab. Wie man sich in der Gruppe zu verhalten hat, sollte der Gruppengr�nder am besten als Beitrag dort schreiben. Nat�rlich kann sich der Gruppengr�nder nicht �ber die allgemeinen Gesch�ftsbedingungen oder die Hausordnung dieser Seite hinwegsetzen. Die Regeln m�ssen also im Rahmen bleiben. Die Moderationsgewalt und die alleinige Verantwortung f�r eine Gruppe liegt beim Gruppengr�nder, weshalb bei Fragen und Problemen dieser auch der erste Ansprechpartner f�r Dich sein sollte. Hilft dies nichts und besteht ein gravierendes Problem, kannst Du dich vertrauensvoll an den / die Seitenbetreiber bzw. den Support dieser Plattform wenden - um Dein Anliegen wird sich dann gek�mmert.');
define('_LOBBY_HELP_FUNCTIONS',					'Funktionen und M�glichkeiten einer Gruppe');
define('_LOBBY_HELP_COORDS',					'Standort festlegen');
define('_LOBBY_HELP_COORDS_TEXT',				'Die Gruppe kann mit einer Koordinate verkn�pft werden und bekommt dann auf der Startseite eine Karte mit eingeblendet, wo die Gruppe zu Hause ist. So erkennt man sofort, wo eine Gruppe regional hingeh�rt. Zudem k�nnen alle Gruppen einer Kategorie so grafisch auf eine Landkarte projeziert werden, was bei der regionalen Suche nach Gruppen helfen kann.');
define('_LOBBY_HELP_NEWS',						'Neuigkeiten und Artikel');
define('_LOBBY_HELP_NEWS_TEXT',					'Jede Gruppe hat ein eigenes Newssystem und kann so Artikel ver�ffentlichen. Beim Ver�ffentlichen l�sst sich leicht festlegen, welcher Personenkreis (G�ste, Benutzer der Seite, Mitglieder der Gruppe) die Nachricht lesen darf. Die Nachrichten werden dann bei der Gruppe stets in der Men�spalte eingeblendet und sind auch per RSS-Feed abrufbar.');
define('_LOBBY_HELP_FORUMS',					'Diskussionsforen');
define('_LOBBY_HELP_FORUMS_TEXT',				'Jede Gruppe kann eine beliebig gro�e Forenlandschaft einrichten. Hier kann auch festgelegt werden, welcher Personenkreis (G�ste, Benutzer der Seite, Mitglieder der Gruppe) das Forum einsehen darf bzw. benutzen darf. Hier ist zu beachten, welche Wirkung die Foren erzielen sollen. Manchmal bietet es sich an, wenn man Interessenten einen Einblick in die Gruppe geben will, bestimmte Foren auch f�r Seitenmitglieder bzw. G�ste einsehbar bzw. nutzbar zu machen.');
define('_LOBBY_HELP_FORUMS_TEXT2',				'Foren und Beitr�ge k�nnen ins Abonnement genommen werden. Das bedeutet dann, dass Du bei neuen Beitr�ge oder Antworten automatisch dieses per Email zugeschickt bekommst.');
define('_LOBBY_HELP_FORUMS_TEXT3',				'Beim Einrichten einer Gruppe wird die M�glichkeit angeboten, eine Standard-Forenlandschaft mit zu erstellen. Diese kann als Anhalt direkt mit generiert werden und erleichtert neuen Gruppengr�ndern die Arbeit. Selbstverst�ndlich lassen sich Foren im Nachhinein ver�ndern oder wieder l�schen.');
define('_LOBBY_HELP_MISC',						'Verschiedenes');
define('_LOBBY_HELP_NAVIGATION_HINT',			'Bei der Nutzung der Gruppen solltest Du unbedingt die Nutzung deiner Browser-Tasten f�r "vor" und "zur�ck" verzichten. Nutzt Du diese Tasten, kann dies zu Fehler f�hren. Deswegen bitte wenn m�glich zur Navigation nur die Links auf den Seiten verwenden.');

// forum legend
define('_LOBBY_FORUM_LEGEND',					'Symbol-Erkl�rungen');
define('_LOBBY_FORUM_HOT_TOPIC',				'Vieldiskutiertes Thema');
define('_LOBBY_FORUM_TOPIC_MARKED',				'Markiertes Thema');
define('_LOBBY_FORUM_LAST_TOPIC_LINK',		    'Link zu aktuellster Antwort (roter Rand = ungelesene Antwort)');

// list
define('_LOBBY_SORT_CRITERIA',                  'Anzeige �ndern / neu sortieren');
define('_LOBBY_ALPHABETICAL',                   'alphabetisch (A-Z)');
define('_LOBBY_LATEST',                         'Gr�ndungsdatum (neueste zuerst)');
define('_LOBBY_COUNTEDMEMBERS',                 'Mitgliederanzahl');
define('_LOBBY_MAP',                            'alle als Karte anzeigen');
define('_LOBBY_NO_CAT_FILTER',                  'alle Kategorien anzeigen');
define('_LOBBY_RELOAD',                         'neu laden');

// albummanagement

define('_LOBBY_ALBUM_UPDATED',                  'Album aktualisiert');
define('_LOBBY_ALBUM_MANAGEMENT',               'Gruppen-Alben verwalten');
define('_LOBBY_ALBUM_MANAGEMENT_EXPLANATION',   'Hier kannst Du f�r deine Gruppe Alben anlegen. Diese Alben k�nnen dann durch die Gruppe gef�llt werden. Jeder kann dann ganz einfach aus seinen Benutzerbildern Bilder in das Album kopieren. Die Alben selbst werden dann nach Datum sortiert, d.h. das neueste Album ist ganz oben.');
define('_LOBBY_FORUM_EXISTING_ALBUMS',          'Angelegte Alben');
define('_LOBBY_ALBUM_DATE',                     'Verkn�pftes Datum');
define('_LOBBY_ALBUM_TITLE',                    'Alben-Titel');
define('_LOBBY_ALBUM_DESCRIPTION',              'Alben-Beschreibung');
define('_LOBBY_ACTION',                         'Aktion');
define('_LOBBY_ADD_NEW_ALBUM',                  'Neues Album erstellen');
define('_LOBBY_ALBUM_PUBLIC_STATUS',            'Regelung der Zugriffsrechte auf das Album');
define('_LOBBY_ALBUM_STORE_UPDATE',             'Album anlegen oder Daten aktualisieren');
define('_LOBBY_ALBUM_CREATED',                  'Das Album ist nun erstelle und Gruppenmitglieder k�nnen Bilder hinzuf�gen');
define('_LOBBY_ALBUM_DELETE',                   'Album l�schen');
define('_LOBBY_GROUP_ALBUMS',                   'Foto-Alben');
define('_LOBBY_ALBUMS_UPLOAD_PICTURES_FIRST',   'Du kannst nur Bilder hinzuf�gen, welche in deinem Benutzeralbum sind');
define('_LOBBY_EDITMODE_ALBUM_HINT',            'Alle Fotos, welche sich in Ihrem Benutzeralbum befinden, sind hier dargestellt. Mit einem Klick auf das Foto wird es dem Album hinzugef�gt.');
define('_LOBBY_ALBUM_ADDMODE_OFF',              'Modus zum Hinzuf�gen von Bildern deaktivieren');
define('_LOBBY_ALBUM_ADDMODE_ON',               'Modus zum Hinzuf�gen von Bildern aktivieren');
define('_LOBBY_ALBUM_OVERVIEW',                 'Zur�ck zur Alben-�bersicht der Gruppe');
define('_LOBBY_PICTURE_ADDED',                  'Das Bild wurde dem Album hinzugef�gt. Wichtig: Das Bild wurde im Gruppenalbum nur referenziert, d.h. wenn das Bild sp�ter aus der eigenen Galerie gel�scht wird, wird es automatisch auch vom Gruppenalbum entfernt.');
define('_LOBBY_PICTURE_ADD_ERROR',              'Das Bild konnte dem Album nicht hinzugef�gt werden.');
define('_LOBBY_PICTURE_ALREADY_EXISTS',         'Das Bild existiert schon in diesem Album und kann nicht zweimal hinzugef�gt werden');
define('_LOBBY_NO_PICTURE_AVAILABLE_OR_VISIBLE','Es wurde entweder noch kein Bild im Album hinzugef�gt oder es fehlen Dir Zugriffsrechte auf das Album');
define('_LOBBY_UPLOADED_PICTURES',              'Hochgeladene Bilder');
define('_LOBBY_CLICK_AND_USE_CURSOR_FOR_SLIDESHOW',          'Nach Klick auf ein Bild kann mit den Cursortasten bequem weitergeschalten werden!');
define('_LOBBY_DELETE_PICTURE_ABOVE',           'Obiges Bild aus dem Album entfernen');
define('_LOBBY_SHOW_DELETE_LINKS',              'Links zum Entfernen der Bilder anzeigen.');
define('_LOBBY_PICTURE_DELETED',                'Bild wurde entfernt');
define('_LOBBY_PICTURE_ADD_ERROR',              'Bild konnte nicht entfernt werden');
define('_LOBBY_PICTURE_DEL_ERROR',              'Das Bild konnte nicht gel�scht werden. M�glicherweise sind die hierf�r notwendigen Zugriffsrechte nicht vorhanden.');
define('_LOBBY_NO_ALBUMS',                      'Keine Alben bisher angelegt');
define('_LOBBY_GROUP_ADMIN_ALBUM_MANAGEMENT',   'Gruppen-Bildergalerien');
define('_LOBBY_ALBUM_DELETED',                  'Album gel�scht');
define('_LOBBY_ALBUM_DELETE_ERROR',             'Fehler: Album konnte nicht gel�scht werden');
define('_LOBBY_LATEST_PICTURE',                 'Neuester Bilderupload');
define('_LOBBY_SHOW_ALL_ALBUMS',                'Alle Gruppen-Alben anzeigen');
define('_LOBBY_FORUMS_SHOW_NEWS_IN_BOXES',      'Die neuesten Nachrichten der Gruppe seitlich automatisch aufklappen und anzeigen');
define('_LOBBY_FORUMS_SHOW_FORUM_LINKS_IN_BOXES',              'Die Foren-Schnell-Links seitlich automatisch aufklappen und anzeigen');
define('_LOBBY_FORUMS_SHOW_LATEST_ALBUM_PICTURE_IN_BOXES',              'Letzten Bilder-Upload der Gruppenalben seitlich automatisch aufklappen und anzeigen');
define('_LOBBY_VISIT_ALBUM',                     'Album aufrufen');
define('_LOBBY_NO_PERM_TO_DEL_PICTURE',          'Dieses Bild kann nur durch den Gruppenbetreiber oder den Inhaber des Bildes gel�scht werden!');
define('_LOBBY_ALBUM_DELETED',                  'Das Album wurde gel�scht');
define('',              '');
define('',              '');
define('',              '');
