<?php

defined('DB_SERVER') ? null : define("DB_SERVER", "localhost");
defined('DB_USER') ? null : define("DB_USER", "amir_admin");
defined('DB_PASS') ? null : define("DB_PASS", "12345");
defined('DB_NAME') ? null : define("DB_NAME", "portal_reutrans");

// Mail Config ****
// SMTP Server Settings
defined('SMTP_HOST') ? null : define("SMTP_HOST", "smtp.reutrans.com");
defined('SMTP_PORT') ? null : define("SMTP_PORT", 587);
defined('SMTP_USER') ? null : define("SMTP_USER", "portal@reutrans.com");
defined('SMTP_PASS') ? null : define("SMTP_PASS", "PortalTrans0m");
defined('SMTP_SSL') ? null : define("SMTP_SSL", FALSE);

// Who receive all emails?
defined('SEND_TO') ? null : define("SEND_TO", "portal@reutrans.com");
defined('REPLY_TO') ? null : define("REPLY_TO", "portal@reutrans.com");

// subjects
defined('DEFAULT_SUBJECT') ? null : define("DEFAULT_SUBJECT", "Reutrans");
defined('CUSTOMER_NEW_SUBJECT') ? null : define("CUSTOMER_NEW_SUBJECT", "Reutrans | New Customer");
defined('CUSTOMER_EDIT_SUBJECT') ? null : define("CUSTOMER_EDIT_SUBJECT", "Reutrans | Announcement: Customer Update");
defined('TO_DO_NEW_SUBJECT') ? null : define("TO_DO_NEW_SUBJECT", "Reutrans | TO DO Task");
defined('TO_DO_EDIT_SUBJECT') ? null : define("TO_DO_EDIT_SUBJECT", "Reutrans | Announcement: TO DO Task Update");
defined('TASK_NEW_SUBJECT') ? null : define("TASK_NEW_SUBJECT", "Reutrans | New Task");
defined('TASK_EDIT_SUBJECT') ? null : define("TASK_EDIT_SUBJECT", "Reutrans | Announcement: Task Update");

