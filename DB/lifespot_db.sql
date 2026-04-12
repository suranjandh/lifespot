--
CREATE TABLE activity_log
(
  id           BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  log_name     VARCHAR(191) DEFAULT NULL,
  description  TEXT NOT NULL,
  subject_id   BIGINT(20) UNSIGNED DEFAULT NULL,
  subject_type VARCHAR(191) DEFAULT NULL,
  causer_id    BIGINT(20) UNSIGNED DEFAULT NULL,
  causer_type  VARCHAR(191) DEFAULT NULL,
  properties   TEXT         DEFAULT NULL,
  created_at   TIMESTAMP NULL DEFAULT NULL,
  updated_at   TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX        activity_log_log_name_index (log_name)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 85
  AVG_ROW_LENGTH = 212
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

--
-- Definition for table categories
--
CREATE TABLE categories
(
  category_id   INT(11) NOT NULL AUTO_INCREMENT,
  category_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (category_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 9
  AVG_ROW_LENGTH = 2048
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table categories_sub
--
CREATE TABLE categories_sub
(
  category_sub_id   INT(11) NOT NULL AUTO_INCREMENT,
  category_sub_name VARCHAR(50) NOT NULL,
  category_key      INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (category_sub_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 28
  AVG_ROW_LENGTH = 606
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table dependent_medicals
--
CREATE TABLE dependent_medicals
(
  dependent_medical_member_id     INT(11) NOT NULL,
  dependent_medical_primary_care  VARCHAR(255) DEFAULT NULL,
  dependent_medical_name          VARCHAR(50)  DEFAULT NULL,
  dependent_medical_email         VARCHAR(50)  DEFAULT NULL,
  dependent_medical_phone         VARCHAR(255) DEFAULT NULL,
  dependent_medical_web           VARCHAR(255) DEFAULT NULL,
  dependent_medical_address       VARCHAR(255) DEFAULT NULL,
  dependent_medical_address2      VARCHAR(255) DEFAULT NULL,
  dependent_medical_city          VARCHAR(255) DEFAULT NULL,
  dependent_medical_state         VARCHAR(255) DEFAULT NULL,
  dependent_medical_zip           VARCHAR(30)  DEFAULT NULL,
  dependent_medical_special_notes TEXT         DEFAULT NULL,
  dependent_medical_image         VARCHAR(255) DEFAULT NULL,
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (dependent_medical_member_id)
)
  ENGINE = INNODB
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table dependent_schools
--
CREATE TABLE dependent_schools
(
  dependent_school_member_id     INT(11) NOT NULL,
  dependent_school_name          VARCHAR(50)  DEFAULT NULL,
  dependent_school_grade         VARCHAR(255) DEFAULT NULL,
  dependent_school_email         VARCHAR(50)  DEFAULT NULL,
  dependent_school_phone         VARCHAR(255) DEFAULT NULL,
  dependent_school_counselor     VARCHAR(255) DEFAULT NULL,
  dependent_school_address       VARCHAR(255) DEFAULT NULL,
  dependent_school_address2      VARCHAR(255) DEFAULT NULL,
  dependent_school_city          VARCHAR(255) DEFAULT NULL,
  dependent_school_state         VARCHAR(255) DEFAULT NULL,
  dependent_school_zip           VARCHAR(30)  DEFAULT NULL,
  dependent_school_special_notes TEXT         DEFAULT NULL,
  dependent_school_image         VARCHAR(255) DEFAULT NULL,
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (dependent_school_member_id)
)
  ENGINE = INNODB
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table document_content_types
--
CREATE TABLE document_content_types
(
  document_content_type_id           INT(10) UNSIGNED NOT NULL,
  document_content_type_name         VARCHAR(50) NOT NULL,
  document_content_type_sub_category INT(11) NOT NULL,
  PRIMARY KEY (document_content_type_id)
)
  ENGINE = INNODB
  AVG_ROW_LENGTH = 264
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table document_share_roles
--
CREATE TABLE document_share_roles
(
  document_share_roles_id       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  document_share_roles_role     INT(11) UNSIGNED NOT NULL,
  document_share_roles_document INT(11) UNSIGNED NOT NULL,
  document_share_roles_user     INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (document_share_roles_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 7
  AVG_ROW_LENGTH = 8192
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table documents
--
CREATE TABLE documents
(
  document_id                   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  document_title                VARCHAR(255) DEFAULT NULL,
  document_notes                TEXT         DEFAULT NULL,
  document_file                 VARCHAR(255) DEFAULT NULL,
  document_owner_user_id        INT(11) UNSIGNED NOT NULL,
  document_category             INT(11) NOT NULL DEFAULT 0,
  document_category_sub         INT(11) NOT NULL DEFAULT 0,
  document_category_sub_sub     INT(11) NOT NULL DEFAULT 0,
  document_updated              TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  document_category_sub_sub_sub INT(11) NOT NULL DEFAULT 0,
  document_content_type         INT(11) NOT NULL DEFAULT 0,
  document_created              TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
  document_share_members_all    TINYINT(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (document_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 8
  AVG_ROW_LENGTH = 2730
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table documents_not_applicable
--
CREATE TABLE documents_not_applicable
(
  documents_not_applicable_id      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  documents_not_applicable_hash    TEXT NOT NULL,
  documents_not_applicable_user_id INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (documents_not_applicable_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 6
  AVG_ROW_LENGTH = 8192
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table documents_share
--
CREATE TABLE documents_share
(
  docuemnt_share_id          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  document_share_document_id INT(10) UNSIGNED NOT NULL,
  document_share_member_id   INT(10) UNSIGNED NOT NULL,
  document_share_member_type VARCHAR(50) NOT NULL,
  PRIMARY KEY (docuemnt_share_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 9
  AVG_ROW_LENGTH = 5461
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table email_queue
--
CREATE TABLE email_queue
(
  email_queue_id         BIGINT(20) NOT NULL AUTO_INCREMENT,
  email_queue_user_id    INT(11) DEFAULT NULL,
  email_queue_settings   TEXT        NOT NULL,
  email_queue_template   VARCHAR(50) NOT NULL,
  email_queue_priority   TINYINT(4) NOT NULL DEFAULT 5,
  email_queue_added_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email_queue_fail_times INT(11) NOT NULL DEFAULT 0,
  created_at             TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at             TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (email_queue_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 5
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table empty_logs
--
CREATE TABLE empty_logs
(
  empty_log_id                INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  empty_log_table_name        VARCHAR(255) DEFAULT NULL,
  empty_log_row_id            INT(11) DEFAULT NULL,
  empty_log_action_on         VARCHAR(255) DEFAULT NULL,
  empty_log_number_of_fields  INT(11) DEFAULT NULL,
  empty_log_fields            TEXT         DEFAULT NULL,
  empty_log_image_empty_field VARCHAR(255) DEFAULT '',
  PRIMARY KEY (empty_log_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 41
  AVG_ROW_LENGTH = 1820
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table estates
--
CREATE TABLE estates
(
  estate_id                   INT(11) NOT NULL AUTO_INCREMENT,
  estate_user_id              INT(10) UNSIGNED NOT NULL,
  estate_name                 VARCHAR(255) DEFAULT NULL,
  estate_owner_name           VARCHAR(255) DEFAULT NULL,
  estate_address              VARCHAR(255) DEFAULT NULL,
  estate_address2             VARCHAR(255) DEFAULT NULL,
  estate_city                 VARCHAR(255) DEFAULT NULL,
  estate_zip                  VARCHAR(255) DEFAULT NULL,
  estate_state                VARCHAR(255) DEFAULT NULL,
  estate_notes                TEXT         DEFAULT NULL,
  estate_is_primary_residence TINYINT(4) DEFAULT NULL,
  estate_does_own_home        TINYINT(4) DEFAULT NULL,
  created_at                  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at                  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  estate_image                VARCHAR(255) DEFAULT '',
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (estate_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 5
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table guardian_member
--
CREATE TABLE guardian_member
(
  guardian_member_id        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  guardian_member_dependent INT(11) NOT NULL,
  guardian_member_guardian  INT(11) NOT NULL,
  PRIMARY KEY (guardian_member_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table members
--
CREATE TABLE members
(
  member_id                    INT(11) NOT NULL AUTO_INCREMENT,
  member_owner_user_id         INT(11) NOT NULL,
  member_first_name            VARCHAR(255) DEFAULT NULL,
  member_last_name             VARCHAR(255) DEFAULT NULL,
  member_email                 VARCHAR(255) DEFAULT NULL,
  member_phone                 VARCHAR(20)  DEFAULT NULL,
  member_address               VARCHAR(255) DEFAULT NULL,
  member_address2              VARCHAR(255) DEFAULT NULL,
  member_city                  VARCHAR(255) DEFAULT NULL,
  member_state                 VARCHAR(255) DEFAULT NULL,
  member_zip                   VARCHAR(255) DEFAULT NULL,
  member_gender                VARCHAR(25)  DEFAULT NULL,
  member_maritalStatus         VARCHAR(50)  DEFAULT NULL,
  member_nickName              VARCHAR(100) DEFAULT NULL,
  member_dependents            TINYINT(4) DEFAULT NULL,
  member_image                 VARCHAR(255) DEFAULT '',
  member_role_in_estate        VARCHAR(255) DEFAULT NULL,
  member_relationship_to_owner VARCHAR(255) DEFAULT NULL,
  member_anniversary           DATE         DEFAULT NULL,
  member_special_notes         TEXT         DEFAULT NULL,
  member_is_dependent          TINYINT(4) DEFAULT 0,
  member_is_spouse             TINYINT(4) DEFAULT 0,
  member_is_beneficiary        TINYINT(4) DEFAULT 0,
  member_is_emergency_contact  TINYINT(4) DEFAULT 0,
  member_is_friend             TINYINT(4) DEFAULT 0,
  isAssociatedWithCoTrustee    TINYINT(4) DEFAULT 0,
  member_phone2                VARCHAR(255) DEFAULT NULL,
  member_birth_day             DATE         DEFAULT NULL,
  isAssociatedWithSpouse       TINYINT(4) DEFAULT 0,
  member_associated_user       INT(11) DEFAULT 0,
  member_invitation_status     TINYINT(4) DEFAULT 0,
  member_join_account_access   TINYINT(4) DEFAULT 0,
  member_gifts                 VARCHAR(255) DEFAULT NULL,
  member_age                   TEXT         DEFAULT NULL,
  created_at                   TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at                   TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  member_guardian_member_id    INT(11) DEFAULT NULL,
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (member_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 21
  AVG_ROW_LENGTH = 963
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table members_share
--
CREATE TABLE members_share
(
  member_share_id           INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  member_share_to_member_id INT(10) UNSIGNED NOT NULL,
  member_shared_member_id   INT(10) UNSIGNED NOT NULL,
  member_share_member_type  VARCHAR(255) NOT NULL,
  PRIMARY KEY (member_share_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 10
  AVG_ROW_LENGTH = 3276
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table message_channels
--
CREATE TABLE message_channels
(
  message_channel_id         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  message_channel_type       TINYINT(4) NOT NULL DEFAULT 1 COMMENT '1 - single 2 -group ',
  message_channel_owner_user INT(11) DEFAULT NULL,
  message_channel_sender     INT(11) DEFAULT NULL,
  message_channel_count      INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (message_channel_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table message_group_members
--
CREATE TABLE message_group_members
(
  message_group_members_id       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  message_group_members_group_id INT(11) UNSIGNED NOT NULL,
  message_group_members_user_id  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (message_group_members_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 2
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table message_groups
--
CREATE TABLE message_groups
(
  message_group_id               INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  message_group_owner_user_id    INT(10) UNSIGNED NOT NULL,
  message_group_name             VARCHAR(50)  DEFAULT NULL,
  message_group_members_user_ids VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (message_group_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 5
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table messages
--
CREATE TABLE messages
(
  message_id               INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  message_content          TEXT NOT NULL,
  message_from_user        INT(11) UNSIGNED NOT NULL,
  message_to_user          INT(11) UNSIGNED NOT NULL,
  message_message_group_id INT(11) DEFAULT NULL,
  message_image            VARCHAR(255) DEFAULT NULL,
  message_attachment       VARCHAR(255) DEFAULT NULL,
  message_created_time     TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (message_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 2
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table migrations
--
CREATE TABLE migrations
(
  id        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(191) NOT NULL,
  batch     INT(11) NOT NULL,
  PRIMARY KEY (id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 4
  AVG_ROW_LENGTH = 8192
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

--
-- Definition for table password_resets
--
CREATE TABLE password_resets
(
  email      VARCHAR(191) NOT NULL,
  token      VARCHAR(191) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  INDEX      password_resets_email_index (email)
)
  ENGINE = INNODB
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

--
-- Definition for table pets
--
CREATE TABLE pets
(
  pet_id                 INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  pet_owner_user_id      INT(11) NOT NULL,
  pet_name               VARCHAR(255) DEFAULT NULL,
  pet_gender             VARCHAR(50)  DEFAULT NULL,
  pet_image              VARCHAR(255) DEFAULT '',
  pet_clinic_name        VARCHAR(255) DEFAULT NULL,
  pet_description        VARCHAR(255) DEFAULT NULL,
  pet_tag_id             VARCHAR(255) DEFAULT NULL,
  pet_veterinarian_phone VARCHAR(255) DEFAULT NULL,
  pet_birth_day          DATE         DEFAULT NULL,
  pet_doctor_name        VARCHAR(255) DEFAULT NULL,
  pet_guardian           INT(11) DEFAULT NULL,
  pet_notes              TEXT         DEFAULT NULL,
  created_at             TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at             TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (pet_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 3
  AVG_ROW_LENGTH = 16384
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table profiles
--
CREATE TABLE profiles
(
  profile_id            INT(11) NOT NULL AUTO_INCREMENT,
  profile_user_id       INT(11) NOT NULL,
  profile_first_name    VARCHAR(255) DEFAULT NULL,
  profile_address2      VARCHAR(255) DEFAULT NULL,
  profile_last_name     VARCHAR(255) DEFAULT NULL,
  profile_email         VARCHAR(255) DEFAULT NULL,
  profile_phone         VARCHAR(20)  DEFAULT NULL,
  profile_phone2        VARCHAR(255) DEFAULT NULL,
  profile_address       VARCHAR(255) DEFAULT NULL,
  profile_city          VARCHAR(255) DEFAULT NULL,
  profile_state         VARCHAR(255) DEFAULT NULL,
  profile_zip           VARCHAR(255) DEFAULT NULL,
  profile_gender        VARCHAR(25)  DEFAULT NULL,
  profile_birth_day     DATE         DEFAULT NULL,
  profile_maritalStatus VARCHAR(50)  DEFAULT NULL,
  profile_nickName      VARCHAR(100) DEFAULT NULL,
  profile_dependents    VARCHAR(50)  DEFAULT NULL,
  profile_profile_notes TEXT         DEFAULT NULL,
  profile_image         VARCHAR(255) DEFAULT '',
  profile_age           TEXT         DEFAULT NULL,
  created_at            TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at            TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (profile_id),
  INDEX                 profile_email (profile_email)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 5
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table roles
--
CREATE TABLE roles
(
  role_id   INT(10) UNSIGNED NOT NULL,
  role_name VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (role_id)
)
  ENGINE = INNODB
  AVG_ROW_LENGTH = 1820
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table roles_members
--
CREATE TABLE roles_members
(
  roles_members_roles_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  roles_members_member   INT(11) NOT NULL,
  roles_members_role     INT(11) NOT NULL,
  PRIMARY KEY (roles_members_roles_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 19
  AVG_ROW_LENGTH = 1170
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table sites
--
CREATE TABLE sites
(
  site_id            INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  site_owner_user_id INT(10) UNSIGNED NOT NULL,
  site_name          VARCHAR(255) NOT NULL,
  site_owners        VARCHAR(255) DEFAULT NULL,
  site_image         VARCHAR(255) DEFAULT '',
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (site_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 1
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table task_skips
--
CREATE TABLE task_skips
(
  task_skip_id           BIGINT(20) NOT NULL AUTO_INCREMENT,
  task_skip_task_id      INT(11) DEFAULT NULL,
  task_skip_user_id      INT(11) DEFAULT NULL,
  task_skip_sub_category VARCHAR(255) NOT NULL DEFAULT '',
  task_skip_status       TINYINT(4) NOT NULL DEFAULT 1 COMMENT 'skipped = 1 , deleted = 2',
  PRIMARY KEY (task_skip_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 14
  AVG_ROW_LENGTH = 1489
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table tasks
--
CREATE TABLE tasks
(
  task_id          INT(11) NOT NULL AUTO_INCREMENT,
  task_priority    INT(11) NOT NULL DEFAULT 100 COMMENT '100 is lowest',
  task_message     TEXT         NOT NULL,
  task_category    VARCHAR(255) NOT NULL,
  task_main_url    VARCHAR(255) DEFAULT NULL,
  task_button_text VARCHAR(255) DEFAULT NULL,
  task_popup_id    VARCHAR(255) DEFAULT NULL,
  task_popup_title VARCHAR(255) DEFAULT NULL,
  task_popup_body  TEXT         DEFAULT NULL,
  PRIMARY KEY (task_id)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 45
  AVG_ROW_LENGTH = 381
  CHARACTER SET latin1
  COLLATE latin1_swedish_ci;

--
-- Definition for table users
--
CREATE TABLE users
(
  id                        BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name                VARCHAR(191) NOT NULL,
  last_name                 VARCHAR(191) NOT NULL,
  email                     VARCHAR(191) NOT NULL,
  email_verified_at         TIMESTAMP NULL DEFAULT NULL,
  password                  VARCHAR(191) NOT NULL,
  remember_token            VARCHAR(100) DEFAULT NULL,
  created_at                TIMESTAMP NULL DEFAULT NULL,
  updated_at                TIMESTAMP NULL DEFAULT NULL,
  user_status               TINYINT(4) DEFAULT 1,
  spouse_logged             TINYINT(4) DEFAULT 0,
  user_sessions_last_active VARCHAR(255) DEFAULT NULL COMMENT 'this is PHP time()',
  user_access               TINYINT(4) DEFAULT 0 COMMENT '0 => estate 1 => kid',
  action_on VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX users_email_unique (email)
)
  ENGINE = INNODB
  AUTO_INCREMENT = 5
  AVG_ROW_LENGTH = 4096
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

--
-- Dumping data for table categories
--
INSERT INTO categories
VALUES
  (1, 'Estate Profile'),
  (2, 'My Family'),
  (3, 'Work & Education'),
  (4, 'Financial & Retirement'),
  (5, 'Health & Ongoing Care'),
  (6, 'My Wishes'),
  (7, 'Members'),
  (8, 'Kid Profile');

--
-- Dumping data for table categories_sub
--
INSERT INTO categories_sub
VALUES
  (1, 'Estate', 1),
  (2, 'Profile', 1),
  (3, 'Emergency Contacts', 1),
  (4, 'Marital Status', 2),
  (5, 'Dependents', 2),
  (6, 'Beneficiaries', 2),
  (7, 'Pets', 2),
  (8, 'Employment', 3),
  (9, 'Education', 3),
  (10, 'Military', 3),
  (11, 'Volunteer', 3),
  (12, 'Banking', 4),
  (13, 'Assets', 4),
  (14, 'Retirement', 4),
  (15, 'Real Estate', 4),
  (16, 'Tax', 4),
  (17, 'Business', 4),
  (18, 'Health Insurance', 5),
  (19, 'Dental Insurance', 5),
  (20, 'Long Term Care', 5),
  (21, 'Arrangements', 6),
  (22, 'Foundation', 6),
  (23, 'Scholarship', 6),
  (24, 'Personal Messages', 6),
  (25, 'Members', 7),
  (26, 'Sites', 8),
  (27, 'Friends', 8);

--
-- Dumping data for table document_content_types
--
INSERT INTO document_content_types
VALUES
  (1, 'Simple Will', 1),
  (2, 'Pourover Will', 1),
  (3, 'Codicil', 1),
  (4, 'Will w/Test. Trust', 1),
  (5, 'Assignment of Assets', 1),
  (6, 'Certificate of Trust', 1),
  (7, 'Deed', 1),
  (8, 'Living Will', 1),
  (9, 'POA - Health', 1),
  (10, 'POA - General', 1),
  (11, 'POA - Springing', 1),
  (12, 'Do Not Resuscitate (DNR)', 1),
  (13, 'Schedule A', 1),
  (14, 'Homestead', 1),
  (15, 'One Trust', 1),
  (16, 'Two Trust', 1),
  (17, 'Three Trust', 1),
  (18, 'Total Amendment & Restatement of Trust', 1),
  (19, 'Trust Amendment', 1),
  (20, 'Guardianship(s) Docs for each dependent', 1),
  (21, 'Care Giver for each pet', 1),
  (22, 'Letter of Intent / Wishes', 1),
  (23, 'Other Estate Related Documents', 1),
  (24, 'POA - Health', 2),
  (25, 'POA - General', 2),
  (26, 'POA - Springing', 2),
  (27, 'Living Will', 2),
  (28, 'Do Not Resuscitate (DNR)', 2),
  (29, 'Birth Certificate', 2),
  (30, 'Naturalization Document(s)', 2),
  (31, 'Passport / Green Card', 2),
  (32, 'ID / Driver’s License', 2),
  (33, 'Misc Documents About Me', 2),
  (34, 'Bucket List', 2),
  (35, 'Resume', 2),
  (36, 'Memberships', 2),
  (37, 'Baptism Certificate', 2),
  (38, 'Other Profile Related Documents', 2),
  (39, 'Marriage Certificate', 4),
  (40, 'Prenuptial Agreement', 4),
  (41, 'Divorce Agreement', 4),
  (42, 'Prenuptial Agreement', 4),
  (43, 'Divorce Agreement', 4),
  (44, 'Other Marriage Related Documents', 4),
  (45, 'Birth Certificate', 5),
  (46, 'Guardianship Documents', 5),
  (47, 'Immunization Records', 5),
  (48, 'Medical History', 5),
  (49, 'Medical Records', 5),
  (50, 'School Transcripts', 5),
  (51, 'School Related Documents', 5),
  (52, 'Other Documents for This Dependent', 5),
  (53, 'Beneficiary Designations', 6),
  (54, 'List of Accounts for This Beneficiary', 6),
  (55, 'Other Beneficiary Documents', 6),
  (56, 'Pet'' s Medical Records ', 7),
  (57, ' Pet''s Emergency Instructions', 7),
  (58, 'Pedigree Record', 7),
  (59, 'Other Pet Related Documents', 7),
  (60, 'Emergency Instructions', 3),
  (61, 'Important Phone Numbers List', 3),
  (62, 'Other Emergency Documents', 3);

--
-- Dumping data for table message_channels
--

-- Table lifespot_laravel_suranjan.message_channels does not contain any data (it is empty)

--
-- Dumping data for table migrations
--
INSERT INTO migrations
VALUES
  (1, '2014_10_12_000000_create_users_table', 1),
  (2, '2014_10_12_100000_create_password_resets_table', 1),
  (3, '2019_08_11_011313_create_activity_log_table', 2);

--
-- Dumping data for table password_resets
--

-- Table lifespot_laravel_suranjan.password_resets does not contain any data (it is empty)

--
-- Dumping data for table roles
--
INSERT INTO roles
VALUES
  (100, 'Executor'),
  (150, 'Co Executor'),
  (200, 'Trustee'),
  (250, 'Co-Trustee'),
  (300, 'Beneficiary'),
  (350, 'Successors Trustee'),
  (400, 'Legal Guardian'),
  (450, 'Heir'),
  (500, 'Emergency Contact');

--
-- Dumping data for table sites
--

-- Table lifespot_laravel_suranjan.sites does not contain any data (it is empty)

--
-- Dumping data for table tasks
--
INSERT INTO tasks
VALUES
(1, 1, 'your email invitation was successfully sent to [member-full-name].', 'invitation_email_task', NULL, 'Got It',
 NULL, NULL, NULL),
(2, 1,
 'your email invitation could NOT be sent to  [member-full-name]. Please verify the email address is correct and select ''Invite''.',
 'invitation_email_task', NULL, 'Verify Email', NULL, NULL, NULL),
(3, 1,
 'there seems to be a problem delivering your invitation to [membe-full-name]. You may want to contact   [member-full-name]  to verify you have the correct email address. ',
 'invitation_email_task', NULL, 'Got It', NULL, NULL, NULL),
(4, 1,
 'you can always check the status of an email invitation anytime by going to Members. Look for this indicator <i class="far fa-dot-circle" style="color:green;"></i>... green is good and red indicates a problem. Hover over the indicator <i class="far fa-dot-circle" style="color:red;"></i> to see the exact status.',
 'invitation_email_task', NULL, 'Got It', NULL, NULL, NULL),
(5, 1,
 '<i class="fas fa-exclamation-triangle" style="color:orange"></i> IMPORTANT! [member-full-name]  has deleted their LifeSpot account - you are no longer sharing information with them.',
 'invitation_email_task', NULL, 'Got It', NULL, NULL, NULL),
(6, 1,
 'It does not look like you have invited [member-full-name] to be a part of your LifeSpot yet. Please\r\nclick button to invite.',
 'invitation_email_task', NULL, 'Invite', NULL, NULL, NULL),
(7, 1, 'watching this welcome video helps you get started.', 'welcome_task', NULL, 'Watch Welcome Video',
 'taskShowModal1', 'How to manage your tasks', ''),
(8, 1, 'there is a great video about managing your tasks.  Click the button to see it.', 'welcome_task', NULL,
 'Watch Video', 'taskShowModal2', 'Getting Started with LifeSpot', ''),
(10, 1,
 'answering all questions on a form will help complete your LifeSpot account.  Lets get started by completing a few quick questions about your estate.',
 'estates', NULL, 'Finish Estate', NULL, NULL, NULL),
(11, 1, 'field_empty', 'estates', NULL, 'Estate', NULL, NULL, NULL),
(12, 1, 'your profile can easily be shared once you have completed the profile form.', 'profiles', NULL,
 'Complete Profile', NULL, NULL, NULL),
(13, 1, 'field_empty_1', 'profiles', NULL, 'Profile', NULL, NULL, NULL),
(14, 1, 'you mentioned you are married. Please complete these questions about your spouse.', 'spouses', NULL,
 'Update Spouse Info', NULL, NULL, NULL),
(15, 1, 'field_empty', 'spouses', NULL, 'Spouse', NULL, NULL, NULL),
(16, 1,
 ' dont forget to upload documents about your estate, yourself . Please go back to those forms and upload your important documents. ',
 'no_document_task', NULL, 'Got It', NULL, NULL, NULL),
(17, 1,
 ' dont forget to upload documents about your estate, yourself or your marriage. Please go back to those forms and upload your important documents.  ',
 'no_document_task', NULL, 'Got It', NULL, NULL, NULL),
(18, 1,
 '  dont forget to upload documents for your dependents, beneficiaries, pets, and emergency contacts. Please go back to those forms and upload your important documents. ',
 'no_document_task', NULL, 'Got It', NULL, NULL, NULL),
(19, 1, 'Would you like to add a dependent to your estate?', 'dependents', NULL, 'Add Dependent', NULL, NULL, NULL),
(20, 1,
 'it is a good idea to keep information readily available when it comes to your dependents.  Please take a moment to answer questions about your dependent',
 'dependents', NULL, 'Edit', NULL, NULL, NULL),
(21, 1, 'field_empty', 'dependents', NULL, 'Dependent', NULL, NULL, NULL),
(22, 1, 'Would you like to add the remaining dependent ?', 'dependents', NULL, 'Add Dependent', NULL, NULL, NULL),
(23, 1, 'Would you like to add the next dependent?', 'dependents', NULL, 'Add Dependent', NULL, NULL, NULL),
(24, 1, 'Would you like to add a beneficiary to your estate?', 'beneficiary', NULL, 'Add Beneficiary', NULL, NULL,
 NULL),
(25, 1,
 'it is a good idea to keep information readily available when it comes to your beneficiary.  Please take a moment to answer questions about your beneficiary',
 'beneficiary', NULL, 'Edit', NULL, NULL, NULL),
(26, 1, 'field_empty', 'beneficiary', NULL, 'Beneficiary', NULL, NULL, NULL),
(27, 1, 'Would you like to add a emergency contact to your estate?', 'emergency_contact', NULL, 'Add Emergency Contact',
 NULL, NULL, NULL),
(28, 1,
 'it is a good idea to keep information readily available when it comes to your emergency contact.  Please take a moment to answer questions about your emergency contact',
 'emergency_contact', NULL, 'Edit', NULL, NULL, NULL),
(29, 1, 'field_empty', 'emergency_contact', NULL, 'Emergency Contact', NULL, NULL, NULL),
(30, 1,
 'members are the most important part of your estate.  Please answer a few questions about the members of your estate.  Lets update information for ',
 'members', NULL, 'Update', NULL, NULL, NULL),
(31, 1, 'field_empty', 'members', NULL, 'Member', NULL, NULL, NULL),
(32, 1, 'Would you like to add a pet to your estate?', 'pet', NULL, 'Add Pet', NULL, NULL, NULL),
(33, 1,
 'it is a good idea to keep information readily available when it comes to your pet.  Please take a moment to answer questions about your pet',
 'pet', NULL, 'Edit', NULL, NULL, NULL),
(34, 1, 'field_empty', 'pet', NULL, 'Pet', NULL, NULL, NULL),
(35, 1,
 ' your [member-first-name] "[document-content-type]" called "[document-name]" may be out of date. You created it on [document-created-date]. Click the "Update Now" button.',
 'document_content_type_expired_task', NULL, 'Update Now', NULL, NULL, NULL),
(36, 1, 'defining key roles in your estate is important.  Would you like to add the role of [role] to your estate?',
 'roles_task', NULL, 'Add [role]', NULL, NULL, NULL),
(37, 1, 'legal guardians are important for your estate.  Would you like to add a guardian for [dependent-name]?',
 'dependent_guardian_roles_task', NULL, 'Add Guardian', NULL, NULL, NULL),
(38, 1, 'You can click this button to add more tasks and keep building your LifeSpot account...', 'more_tasks', NULL,
 'More Tasks', NULL, NULL, NULL),
(39, 1, 'Would you like to add a friend to your account?', 'friend', NULL, 'Add Friend', NULL, NULL, NULL),
(40, 1,
 'it is a good idea to keep information readily available when it comes to your friends.  Please take a moment to answer questions about your friend ',
 'friend', NULL, 'Edit', NULL, NULL, NULL),
(41, 1, 'field_empty', 'friend', NULL, 'Friend', NULL, NULL, NULL),
(42, 1, 'Would you like to add a site to your account?', 'site', NULL, 'Add Site', NULL, NULL, NULL),
(43, 1,
 'it is a good idea to keep information readily available when it comes to your sites.  Please take a moment to answer questions about your site ',
 'site', NULL, 'Edit', NULL, NULL, NULL),
(44, 1, 'field_empty', 'site', NULL, 'Site', NULL, NULL, NULL)
(
45,
1,
'Would you like to add a spouse to your account?',
'spouses',
NULL,
'Add Spouse',
NULL,
NULL,
NULL
);

--
-- Enable foreign keys
--
