-- AJARA database schema (Laravel) - MySQL 8.0+
-- Import this file through phpMyAdmin or MySQL CLI.
-- Demo login: amanda@example.com / password123
CREATE DATABASE IF NOT EXISTS ajara_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ajara_db;
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS competitions;
DROP TABLE IF EXISTS sessions;
DROP TABLE IF EXISTS password_reset_tokens;
DROP TABLE IF EXISTS cache_locks;
DROP TABLE IF EXISTS cache;
DROP TABLE IF EXISTS failed_jobs;
DROP TABLE IF EXISTS job_batches;
DROP TABLE IF EXISTS jobs;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS migrations;

CREATE TABLE migrations (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  migration VARCHAR(255) NOT NULL,
  batch INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  nim VARCHAR(30) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(30) NOT NULL DEFAULT 'mahasiswa',
  avatar VARCHAR(255) NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE password_reset_tokens (
  email VARCHAR(255) NOT NULL PRIMARY KEY,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE sessions (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  user_id BIGINT UNSIGNED NULL,
  ip_address VARCHAR(45) NULL,
  user_agent TEXT NULL,
  payload LONGTEXT NOT NULL,
  last_activity INT NOT NULL,
  KEY sessions_user_id_index (user_id),
  KEY sessions_last_activity_index (last_activity),
  CONSTRAINT sessions_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cache (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  value MEDIUMTEXT NOT NULL,
  expiration INT NOT NULL,
  KEY cache_expiration_index (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE cache_locks (
  `key` VARCHAR(255) NOT NULL PRIMARY KEY,
  owner VARCHAR(255) NOT NULL,
  expiration INT NOT NULL,
  KEY cache_locks_expiration_index (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE jobs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  queue VARCHAR(255) NOT NULL,
  payload LONGTEXT NOT NULL,
  attempts TINYINT UNSIGNED NOT NULL,
  reserved_at INT UNSIGNED NULL,
  available_at INT UNSIGNED NOT NULL,
  created_at INT UNSIGNED NOT NULL,
  KEY jobs_queue_index (queue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE job_batches (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  total_jobs INT NOT NULL,
  pending_jobs INT NOT NULL,
  failed_jobs INT NOT NULL,
  failed_job_ids LONGTEXT NOT NULL,
  options MEDIUMTEXT NULL,
  cancelled_at INT NULL,
  created_at INT NOT NULL,
  finished_at INT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE failed_jobs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uuid VARCHAR(255) NOT NULL UNIQUE,
  connection TEXT NOT NULL,
  queue TEXT NOT NULL,
  payload LONGTEXT NOT NULL,
  exception LONGTEXT NOT NULL,
  failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE competitions (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  organizer VARCHAR(255) NOT NULL,
  category ENUM('Kampus','Nasional','Internasional') NOT NULL DEFAULT 'Kampus',
  competition_category VARCHAR(255) NOT NULL DEFAULT 'Lainnya',
  competition_level VARCHAR(255) NOT NULL DEFAULT 'Kampus',
  banner VARCHAR(255) NULL,
  description LONGTEXT NULL,
  requirements LONGTEXT NULL,
  registration_start DATE NULL,
  registration_end DATE NULL,
  event_start DATE NULL,
  event_end DATE NULL,
  registration_url VARCHAR(255) NULL,
  location VARCHAR(255) NULL,
  contact VARCHAR(255) NULL,
  benefits TEXT NULL,
  mode ENUM('Online','Offline') NOT NULL DEFAULT 'Online',
  delivery_mode VARCHAR(255) NOT NULL DEFAULT 'Online',
  fee_amount BIGINT UNSIGNED NOT NULL DEFAULT 0,
  rating DECIMAL(2,1) NOT NULL DEFAULT 0.0,
  review_count INT UNSIGNED NOT NULL DEFAULT 0,
  views INT UNSIGNED NOT NULL DEFAULT 0,
  is_recommended TINYINT(1) NOT NULL DEFAULT 0,
  status ENUM('draft','published','closed') NOT NULL DEFAULT 'draft',
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  KEY competitions_status_category_index (status, category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE registrations (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  competition_id BIGINT UNSIGNED NOT NULL,
  status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  notes TEXT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  UNIQUE KEY registrations_user_id_competition_id_unique (user_id, competition_id),
  CONSTRAINT registrations_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT registrations_competition_id_foreign FOREIGN KEY (competition_id) REFERENCES competitions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE notifications (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  type VARCHAR(40) NOT NULL DEFAULT 'info',
  read_at TIMESTAMP NULL DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  KEY notifications_user_id_read_at_index (user_id, read_at),
  CONSTRAINT notifications_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations (migration,batch) VALUES
('0001_01_01_000000_create_users_table',1),
('0001_01_01_000001_create_cache_table',1),
('0001_01_01_000002_create_jobs_table',1),
('2026_11_09_000001_add_nim_role_avatar_to_users_table',2),
('2026_11_09_000002_create_competitions_table',2),
('2026_11_09_000003_create_registrations_table',2),
('2026_11_09_000004_create_notifications_table',2),
('2026_11_09_000005_add_discovery_fields_to_competitions_table',3);

-- Seed account. Password hash corresponds to: password123
INSERT INTO users (id,name,nim,email,password,role,created_at,updated_at) VALUES
(1,'Amanda Rambe','23000001','amanda@example.com',
'$2y$12$6MhFYL/gYEvXowcyBu5fieNXJ.CXBvffjJU4ehS1vz9kVV06j6o8K','mahasiswa',NOW(),NOW());

-- Example competitions (registration dates are relative to import date).
INSERT INTO competitions
(title,organizer,category,competition_category,competition_level,banner,description,requirements,
 registration_start,registration_end,event_start,event_end,registration_url,location,contact,benefits,
 mode,delivery_mode,fee_amount,rating,review_count,views,is_recommended,status,created_at,updated_at)
VALUES
('National Student Innovation Challenge','Forum Inovasi Mahasiswa Indonesia','Nasional','Karya Tulis Ilmiah','Nasional',
'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1000&q=85',
'Kompetisi inovasi mahasiswa untuk menghadirkan solusi kreatif atas tantangan sosial dan teknologi. Peserta mengirimkan karya tulis dan mempresentasikan gagasannya di hadapan dewan juri.',
'Mahasiswa aktif D3/D4/S1. Peserta individu atau tim maksimal 3 orang.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 12 DAY),DATE_ADD(CURDATE(),INTERVAL 19 DAY),DATE_ADD(CURDATE(),INTERVAL 20 DAY),
'https://example.com/daftar','Online','Panitia Forum Inovasi Mahasiswa Indonesia','Total hadiah Rp15.000.000, sertifikat nasional, dan mentoring inovasi.',
'Online','Online',0,4.8,32,820,1,'published',NOW(),NOW()),
('International Business Case Challenge','Global Youth Network','Internasional','Business Plan','Internasional',
'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1000&q=85',
'Tantangan pemecahan studi kasus bisnis untuk mahasiswa yang ingin menguji kemampuan analisis, strategi, dan kerja sama tim.',
'Mahasiswa aktif. Tim beranggotakan 2–4 orang dan mampu berbahasa Inggris.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 20 DAY),DATE_ADD(CURDATE(),INTERVAL 27 DAY),DATE_ADD(CURDATE(),INTERVAL 28 DAY),
'https://example.com/daftar','Jakarta & Online','Panitia Global Youth Network','Trophy, sertifikat internasional, networking, dan hadiah uang tunai.',
'Online','Hybrid',75000,4.9,25,1240,1,'published',NOW(),NOW()),
('National Creative Poster Festival','Kreativa Student Society','Nasional','Desain Poster','Nasional',
'https://images.unsplash.com/photo-1541701494587-cb58502866ab?auto=format&fit=crop&w=1000&q=85',
'Festival desain poster bertema masa depan berkelanjutan. Tuangkan ide dan pesan positif melalui karya visual yang komunikatif.',
'Mahasiswa aktif dari seluruh perguruan tinggi di Indonesia. Karya orisinal dan belum pernah dipublikasikan.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 8 DAY),DATE_ADD(CURDATE(),INTERVAL 15 DAY),DATE_ADD(CURDATE(),INTERVAL 16 DAY),
'https://example.com/daftar','Online','Panitia Kreativa Student Society','Hadiah jutaan rupiah, e-certificate, dan publikasi karya.',
'Online','Online',25000,4.7,18,690,0,'published',NOW(),NOW()),
('UI/UX Design Sprint 2026','Digital Product Community','Kampus','UI/UX Design','Regional',
'https://images.unsplash.com/photo-1559028012-481c04fa702d?auto=format&fit=crop&w=1000&q=85',
'Kompetisi perancangan pengalaman pengguna untuk menyelesaikan masalah sehari-hari melalui solusi digital.',
'Mahasiswa aktif. Individu atau tim maksimal 3 orang.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 6 DAY),DATE_ADD(CURDATE(),INTERVAL 13 DAY),DATE_ADD(CURDATE(),INTERVAL 14 DAY),
'https://example.com/daftar','Medan & Online','Panitia Digital Product Community','Sertifikat, mentoring portofolio, dan hadiah perangkat digital.',
'Online','Hybrid',0,4.6,14,520,1,'published',NOW(),NOW()),
('Indonesia Student Programming Contest','CodeCampus Indonesia','Nasional','Programming','Nasional',
'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?auto=format&fit=crop&w=1000&q=85',
'Ajang adu logika dan kemampuan coding untuk membangun solusi komputasional secara efektif.',
'Mahasiswa aktif. Menguasai dasar pemrograman dan algoritma.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 15 DAY),DATE_ADD(CURDATE(),INTERVAL 22 DAY),DATE_ADD(CURDATE(),INTERVAL 23 DAY),
'https://example.com/daftar','Online','Panitia CodeCampus Indonesia','Uang pembinaan, sertifikat, dan kesempatan magang.',
'Online','Online',0,4.8,41,980,0,'published',NOW(),NOW()),
('National English Debate Open','University Debate Forum','Nasional','Debat','Nasional',
'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1000&q=85',
'Kompetisi debat bahasa Inggris untuk melatih berpikir kritis, riset, dan kemampuan argumentasi.',
'Tim terdiri dari 3 mahasiswa aktif dan 1 adjudicator pendamping.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 25 DAY),DATE_ADD(CURDATE(),INTERVAL 32 DAY),DATE_ADD(CURDATE(),INTERVAL 33 DAY),
'https://example.com/daftar','Universitas Negeri Jakarta','Panitia University Debate Forum','Piala, uang pembinaan, dan sertifikat nasional.',
'Offline','Offline',100000,4.5,16,470,0,'published',NOW(),NOW()),
('Student Photography Awards','Ruang Visual Nusantara','Kampus','Fotografi','Regional',
'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?auto=format&fit=crop&w=1000&q=85',
'Abadikan cerita di sekitarmu melalui fotografi yang kuat secara visual dan bermakna.',
'Mahasiswa aktif. Foto diambil sendiri dan tidak melanggar hak cipta.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 10 DAY),DATE_ADD(CURDATE(),INTERVAL 17 DAY),DATE_ADD(CURDATE(),INTERVAL 18 DAY),
'https://example.com/daftar','Online','Panitia Ruang Visual Nusantara','Pameran karya, hadiah kamera, dan sertifikat.',
'Online','Online',0,4.4,9,310,0,'published',NOW(),NOW()),
('Young Essayist Competition','Literasi Muda Indonesia','Kampus','Essay','Kampus',
'https://images.unsplash.com/photo-1455390582262-044c88f291e8?auto=format&fit=crop&w=1000&q=85',
'Kompetisi esai untuk menyampaikan gagasan kritis, argumentatif, dan solutif terhadap isu masa kini.',
'Mahasiswa aktif D3/D4/S1. Esai ditulis dalam bahasa Indonesia.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 4 DAY),DATE_ADD(CURDATE(),INTERVAL 11 DAY),DATE_ADD(CURDATE(),INTERVAL 12 DAY),
'https://example.com/daftar','Online','Panitia Literasi Muda Indonesia','Hadiah uang tunai, sertifikat, dan publikasi esai terbaik.',
'Online','Online',15000,4.6,21,430,0,'published',NOW(),NOW()),
('National Science Olympiad for University','Sains Prestasi Foundation','Nasional','Olimpiade','Nasional',
'https://images.unsplash.com/photo-1532094349884-543bc11b234d?auto=format&fit=crop&w=1000&q=85',
'Uji pemahaman konsep dan kemampuan analisis sains melalui olimpiade tingkat nasional.',
'Mahasiswa aktif. Pilihan bidang: matematika, fisika, biologi, dan kimia.',DATE_SUB(CURDATE(),INTERVAL 2 DAY),DATE_ADD(CURDATE(),INTERVAL 18 DAY),DATE_ADD(CURDATE(),INTERVAL 25 DAY),DATE_ADD(CURDATE(),INTERVAL 26 DAY),
'https://example.com/daftar','Online','Panitia Sains Prestasi Foundation','Medali, sertifikat, dan beasiswa pembinaan.',
'Online','Online',50000,4.7,28,760,0,'published',NOW(),NOW());

INSERT INTO notifications (user_id,title,message,type,created_at,updated_at) VALUES
(1,'Pendaftaran lomba baru dibuka','Ada peluang kompetisi baru di AJARA. Yuk cek detailnya!','competition',NOW(),NOW()),
(1,'Jangan lewatkan batas pendaftaran','Periksa deadline lomba favoritmu agar tidak terlewat.','competition',NOW(),NOW()),
(1,'Selamat datang di AJARA','Temukan kompetisi, simpan peluang, dan mulai perjalanan prestasimu.','competition',NOW(),NOW());

SET FOREIGN_KEY_CHECKS=1;
