-- DOMAINS
CREATE DOMAIN SafeDate AS DATE NOT NULL DEFAULT CURRENT_DATE;


-- TABLES
-- R01
DROP TABLE IF EXISTS "user" CASCADE;
CREATE TABLE "user"(
  "id" SERIAL PRIMARY KEY,
  name TEXT NOT NULL,
  username TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  email TEXT UNIQUE NOT NULL,
  about TEXT,
  picture TEXT,
  reputation INTEGER NOT NULL DEFAULT 0
);

-- R02
DROP TABLE IF EXISTS moderator CASCADE;
CREATE TABLE moderator(
  "id" INTEGER PRIMARY KEY,
  CONSTRAINT fk_user
    FOREIGN KEY("id")
      REFERENCES "user"("id")
);

-- R03
DROP TABLE IF EXISTS administrator CASCADE;
CREATE TABLE administrator(
  "id" INTEGER PRIMARY KEY,
  CONSTRAINT fk_moderator
    FOREIGN KEY("id")
      REFERENCES moderator("id")
);

-- R04
DROP TABLE IF EXISTS ban CASCADE;
CREATE TABLE ban(
  id_user INTEGER PRIMARY KEY,
  id_admin INTEGER NOT NULL,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- bans can't have happened in the future
  reason TEXT,
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"("id"),
  CONSTRAINT fk_admin
    FOREIGN KEY(id_admin)
      REFERENCES Administrator("id")
);

-- R05
DROP TABLE IF EXISTS news CASCADE;
CREATE TABLE news(
  "id" SERIAL PRIMARY KEY,
  author INTEGER NOT NULL,
  title TEXT NOT NULL,
  body TEXT,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- news can't be posted in the future
  CONSTRAINT fk_author
    FOREIGN KEY(author)
      REFERENCES administrator("id")
);

-- R06
DROP TABLE IF EXISTS topic_proposal CASCADE;
CREATE TABLE topic_proposal(
  "id" SERIAL PRIMARY KEY,
  id_user INTEGER NOT NULL,
  id_admin INTEGER,
  topic_name TEXT NOT NULL,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- proposals can't have happened in the future
  reason TEXT,
  accepted boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"("id"),
  CONSTRAINT fk_admin
    FOREIGN KEY(id_user)
      REFERENCES administrator("id")
);

-- R07
DROP TABLE IF EXISTS achievement CASCADE;
CREATE TABLE achievement(
  "id" SERIAL PRIMARY KEY,
  title TEXT UNIQUE NOT NULL,
  body TEXT NOT NULL
);

-- R08
DROP TABLE IF EXISTS achieved CASCADE;
CREATE TABLE achieved(
  id_user INTEGER,
  id_achievement INTEGER,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- achievements can't be acquired in the future
  PRIMARY KEY (id_user, id_achievement),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"("id"),
  CONSTRAINT fk_achievement
    FOREIGN KEY(id_achievement)
      REFERENCES achievement("id")
);

-- R09
DROP TABLE IF EXISTS post CASCADE;
CREATE TABLE post(
  "id" SERIAL PRIMARY KEY,
  id_owner INTEGER NOT NULL,
  body TEXT NOT NULL,
  --  score INTEGER NOT NULL DEFAULT 0,  -- derived attribute => view
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- posts can't be made in the future
  CONSTRAINT fk_owner
    FOREIGN KEY(id_owner)
      REFERENCES "user"("id")
);

-- R10
DROP TABLE IF EXISTS vote CASCADE;
CREATE TABLE vote(
  id_post INTEGER,
  id_user INTEGER,
  value smallint CHECK (
    value = 1
    OR value = -1
  ),
  PRIMARY KEY (id_post, id_user),
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post("id"),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"("id")
);

-- R11
DROP TABLE IF EXISTS edit_proposal CASCADE;
CREATE TABLE edit_proposal(
  "id" SERIAL PRIMARY KEY,
  id_post INTEGER NOT NULL,
  id_user INTEGER NOT NULL,
  id_moderator INTEGER,
  body TEXT NOT NULL,
  accepted boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post("id"),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"("id"),
  CONSTRAINT fk_moderator
    FOREIGN KEY(id_moderator)
      REFERENCES moderator("id")
);

-- R12
DROP TABLE IF EXISTS answer CASCADE;
CREATE TABLE answer(
  "id" INTEGER PRIMARY KEY,
  id_question INTEGER NOT NULL,
  CONSTRAINT fk_post
    FOREIGN KEY("id")
      REFERENCES post("id"),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question("id")
);

-- R13
DROP TABLE IF EXISTS comment CASCADE;
CREATE TABLE comment(
  "id" INTEGER PRIMARY KEY,
  id_question INTEGER,
  id_answer INTEGER,
  CHECK (
    (
      id_question = NULL
      AND id_answer != NULL
    )
    OR (
      id_question != NULL
      AND id_answer = NULL
    )
  ),
  CONSTRAINT fk_post
    FOREIGN KEY("id")
      REFERENCES post("id"),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question("id"),
  CONSTRAINT fk_answer
    FOREIGN KEY(id_answer)
      REFERENCES answer("id")
);

-- R14
DROP TABLE IF EXISTS question CASCADE;
CREATE TABLE question(
  "id" INTEGER PRIMARY KEY,
  accepted_answer INTEGER,
  title TEXT UNIQUE NOT NULL,
  bounty smallint NOT NULL CHECK (
    bounty >= 0
    AND bounty <= 500
  ),
  closed boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_post
    FOREIGN KEY("id")
      REFERENCES post("id"),
  CONSTRAINT fk_anser
    FOREIGN KEY(accepted_answer)
      REFERENCES answer("id")
);

-- R15
DROP TABLE IF EXISTS topic CASCADE;
CREATE TABLE topic(
  "id" SERIAL PRIMARY KEY,
  name TEXT UNIQUE NOT NULL
);

-- R16
DROP TABLE IF EXISTS topic_question CASCADE;
CREATE TABLE topic_question(
  id_topic INTEGER,
  id_question INTEGER,
  PRIMARY KEY(id_topic, id_question),
  CONSTRAINT fk_topic
    FOREIGN KEY(id_topic)
      REFERENCES topic("id"),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question("id")
);

-- R17
DROP TABLE IF EXISTS report CASCADE;
CREATE TABLE report(
  id_post INTEGER,
  reporter INTEGER,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- reports can't be made in the future
  reason TEXT,
  PRIMARY KEY(id_post, reporter),
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post("id"),
  CONSTRAINT fk_reporter
    FOREIGN KEY(reporter)
      REFERENCES "user"("id")
);

-- R18
DROP TABLE IF EXISTS notification CASCADE;
CREATE TABLE notification(
  "id" SERIAL PRIMARY KEY,
  "date" SafeDate CHECK ("date" <= CURRENT_DATE), -- can't be notified in the future
  title TEXT NOT NULL,
  body TEXT,
  recipient INTEGER,
  CONSTRAINT fk_recipient
    FOREIGN KEY(recipient)
      REFERENCES "user"("id")
);

-- R19
DROP TABLE IF EXISTS notification_achievement CASCADE;
CREATE TABLE notification_achievement(
  "id" INTEGER PRIMARY KEY,
  id_achievement INTEGER NOT NULL,
  CONSTRAINT fk_notification
    FOREIGN KEY("id")
      REFERENCES notification("id"),
  CONSTRAINT fk_achievement
    FOREIGN KEY(id_achievement)
      REFERENCES achievement("id")
);

-- R20
DROP TABLE IF EXISTS notification_post CASCADE;
CREATE TABLE notification_post(
  "id" INTEGER PRIMARY KEY,
  id_post INTEGER NOT NULL,
  CONSTRAINT fk_notification
    FOREIGN KEY("id")
      REFERENCES notification("id"),
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post("id")
);


-- FUNCTIONS
-- used to store the derived attribute 'score' (see comment in vote table)
CREATE OR REPLACE FUNCTION score(post_id integer)
RETURNS integer
AS
$$
    DECLARE
        total integer;
    BEGIN
        SELECT SUM(value) INTO total
        FROM vote INNER JOIN post ON (post.id = post_id);
        RETURN total;
    END;
$$ LANGUAGE plpgsql;
