<?php

return [
    'name' => 'Name',
    'first_name' => 'Vorname',
    'last_name' => 'Nachname',
    'gender' => [
        'label' => 'Geschlecht',
        'f' => 'w',
        'm' => 'm',
    ],
    'birth_date' => 'Geburtsdatum',
    'house' => 'Haus',
    'blood_status' => [
        'label' => 'Blutstatus',
        'nb' => 'Edelblut',
        'pb' => 'Reinblut',
        'hb' => 'Halbblut',
        'mb' => 'Muggelgeboren',
    ],
    'enrollment_date' => 'Einschreibungsdatum',
    'graduation_date' => 'Abschlussdatum',
    'add_new_student' => 'Neuen Schüler hinzufügen',
    'diploma' => [
        'label' => 'Abschluss',
        'degree' => 'Grad',
        'owl' => 'ZAG',
        'newt' => 'UTZ',
        'se' => 'SA',
        'exp' => 'E',
        'ordinary_wizarding_level' => 'Zauberer allgemeinen Grades',
        'nastily_exhausting_wizarding_test' => 'Unheimlich toller Zauberer',
        'student_exchange' => 'Schüleraustausch',
        'expelled' => 'Verwiesen',
    ],
    'student_file' => 'Schülerakte',
    'sign' => 'Unterschrift',
    'student' => 'Schüler/in',
    'errors' => [
        'full_name_exists' => 'Ein Schüler mit diesem vollen Namen existiert bereits.',
        'house_required' => 'Das Haus ist erforderlich.',
        'blood_status_required' => 'Der Blutstatus ist erforderlich.',
    ],
    'success' => [
        'student_added' => 'Schüler/in erfolgreich hinzugefügt.',
        'student_updated' => 'Schüler/in erfolgreich aktualisiert.',
        'student_deleted' => 'Schüler/in erfolgreich gelöscht.',
    ],
];
