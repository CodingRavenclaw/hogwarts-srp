<?php

/*
|--------------------------------------------------------------------------
| Auth Language Lines (Deutsch)
|--------------------------------------------------------------------------
| Häufig verwendete Texte rund um Anmeldung, Registrierung, Verifizierung,
| Sitzungen, Zwei-Faktor-Authentifizierung und Social Login.
*/

return [

    /*
    |----------------------------------------------------------------------
    | Standard-Laravel-Meldungen
    |----------------------------------------------------------------------
    */
    'failed' => 'Diese Zugangsdaten stimmen nicht mit unseren Unterlagen überein.',
    'password' => 'Das eingegebene Passwort ist falsch.',
    'throttle' => 'Zu viele Anmeldeversuche. Bitte versuche es in :seconds Sekunden erneut.',

    /*
    |----------------------------------------------------------------------
    | Allgemeine Labels
    |----------------------------------------------------------------------
    */
    'email' => 'E-Mail-Adresse',
    'password_label' => 'Passwort',
    'new_password' => 'Neues Passwort',
    'confirm_password' => 'Passwort bestätigen',
    'current_password' => 'Aktuelles Passwort',
    'remember' => 'Angemeldet bleiben',
    'name' => 'Name',
    'username' => 'Benutzername',
    'login' => 'Anmelden',
    'logout' => 'Abmelden',
    'register' => 'Registrieren',
    'or' => 'oder',
    'continue' => 'Weiter',
    'cancel' => 'Abbrechen',

    /*
    |----------------------------------------------------------------------
    | Anmelden / Registrieren / Abmelden
    |----------------------------------------------------------------------
    */
    'sign_in_to_account' => 'Melde dich in deinem Konto an',
    'create_account' => 'Konto erstellen',
    'already_registered' => 'Bereits registriert?',
    'not_registered_yet' => 'Noch kein Konto?',
    'forgot_password' => 'Passwort vergessen?',
    'invalid_login' => 'Die eingegebenen Anmeldedaten sind nicht korrekt. Bitte prüfe E-Mail und/oder Passwort.',
    'logged_out' => 'Du wurdest erfolgreich abgemeldet.',
    'session_expired' => 'Deine Sitzung ist abgelaufen. Bitte melde dich erneut an.',

    /*
    |----------------------------------------------------------------------
    | E-Mail-Verifizierung
    |----------------------------------------------------------------------
    */
    'verify' => [
        'title' => 'E-Mail-Adresse bestätigen',
        'notice' => 'Bevor du fortfährst, überprüfe bitte dein Postfach auf den Bestätigungslink.',
        'link_sent' => 'Ein neuer Bestätigungslink wurde an :email gesendet.',
        'resend' => 'Bestätigungs-E-Mail erneut senden',
        'button' => 'E-Mail bestätigen',
        'verified' => 'Deine E-Mail-Adresse wurde erfolgreich bestätigt.',
        'must_verify' => 'Du musst deine E-Mail-Adresse bestätigen, um fortzufahren.',
    ],

    /*
    |----------------------------------------------------------------------
    | Passwort-Zurücksetzung (UI-Texte, nicht die Standard "passwords.php")
    |----------------------------------------------------------------------
    */
    'passwords' => [
        'title_request' => 'Passwort zurücksetzen',
        'title_reset' => 'Neues Passwort festlegen',
        'send_link' => 'Link zum Zurücksetzen senden',
        'email_instructions' => 'Gib deine E-Mail-Adresse ein, um einen Link zum Zurücksetzen zu erhalten.',
        'reset_button' => 'Passwort zurücksetzen',
        'updated' => 'Dein Passwort wurde aktualisiert.',
        'link_sent' => 'Wir haben dir den Link zum Zurücksetzen des Passworts per E-Mail gesendet.',
    ],

    /*
    |----------------------------------------------------------------------
    | Zwei-Faktor-Authentifizierung (2FA)
    |----------------------------------------------------------------------
    */
    'two_factor' => [
        'title' => 'Zwei-Faktor-Authentifizierung',
        'setup_title' => '2FA einrichten',
        'enable' => '2FA aktivieren',
        'disable' => '2FA deaktivieren',
        'enabled' => '2FA wurde aktiviert.',
        'disabled' => '2FA wurde deaktiviert.',
        'confirm' => 'Bestätigen',
        'code' => 'Bestätigungscode',
        'recovery_codes' => 'Wiederherstellungscodes',
        'enter_code' => 'Gib den sechsstelligen Code aus deiner Authenticator-App ein.',
        'use_recovery' => 'Stattdessen einen Wiederherstellungscode verwenden',
        'invalid_code' => 'Der angegebene Code ist ungültig oder abgelaufen.',
        'regenerate_codes' => 'Wiederherstellungscodes neu erzeugen',
        'codes_generated' => ':count neue Wiederherstellungscodes wurden erstellt.',
        'remember_device' => 'Dieses Gerät für 30 Tage vertrauen',
    ],

    /*
    |----------------------------------------------------------------------
    | Zustimmung & Richtlinien
    |----------------------------------------------------------------------
    */
    'terms' => [
        'agree' => 'Ich akzeptiere die :terms und :privacy.',
        'terms' => 'Nutzungsbedingungen',
        'privacy' => 'Datenschutzerklärung',
        'must_agree' => 'Bitte stimme den Bedingungen zu, um fortzufahren.',
    ],

    /*
    |----------------------------------------------------------------------
    | Social Login / Single Sign-On
    |----------------------------------------------------------------------
    */
    'social' => [
        'continue_with' => 'Weiter mit :provider',
        'link_account' => 'Konto verknüpfen',
        'unlink' => 'Verknüpfung aufheben',
        'linked' => 'Dein :provider-Konto wurde verknüpft.',
        'unlinked' => 'Die Verknüpfung mit :provider wurde entfernt.',
        'failed' => 'Die Anmeldung mit :provider ist fehlgeschlagen. Bitte versuche es erneut.',
    ],

    /*
    |----------------------------------------------------------------------
    | Sicherheitsmeldungen
    |----------------------------------------------------------------------
    */
    'security' => [
        'password_changed' => 'Dein Passwort wurde geändert.',
        'email_changed' => 'Deine E-Mail-Adresse wurde geändert.',
        'relogin_required' => 'Aus Sicherheitsgründen ist eine erneute Anmeldung erforderlich.',
        'device_approved' => 'Neues Gerät bestätigt.',
        'unknown_device' => 'Anmeldung von einem unbekannten Gerät erkannt.',
    ],

    /*
    |----------------------------------------------------------------------
    | Platzhaltertexte (Form Placeholder)
    |----------------------------------------------------------------------
    */
    'placeholders' => [
        'enter_email' => 'E-Mail-Adresse eingeben…',
        'enter_password' => 'Passwort eingeben…',
        'enter_new_password' => 'Neues Passwort eingeben…',
        'enter_name' => 'Vollständigen Namen eingeben…',
        'two_factor_code' => '6-stelligen 2FA-Code eingeben…',
        'recovery_code' => 'Wiederherstellungscode eingeben…',
    ],

];
