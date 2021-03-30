-- CLEANUP
DROP DOMAIN IF EXISTS Today CASCADE;
DROP TYPE IF EXISTS report_state CASCADE;
DROP TABLE IF EXISTS "user" CASCADE;
DROP TABLE IF EXISTS moderator CASCADE;
DROP TABLE IF EXISTS administrator CASCADE;
DROP TABLE IF EXISTS ban CASCADE;
DROP TABLE IF EXISTS news CASCADE;
DROP TABLE IF EXISTS topic_proposal CASCADE;
DROP TABLE IF EXISTS achievement CASCADE;
DROP TABLE IF EXISTS achieved CASCADE;
DROP TABLE IF EXISTS post CASCADE;
DROP TABLE IF EXISTS answer CASCADE;
DROP TABLE IF EXISTS question CASCADE;
DROP TABLE IF EXISTS answer_question;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS vote CASCADE;
DROP TABLE IF EXISTS edit_proposal CASCADE;
DROP TABLE IF EXISTS topic CASCADE;
DROP TABLE IF EXISTS topic_question CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS notification_achievement CASCADE;
DROP TABLE IF EXISTS notification_post CASCADE;


-- DOMAINS
CREATE DOMAIN Today AS DATE DEFAULT CURRENT_DATE;
CREATE TYPE report_state AS ENUM ('pending', 'approved', 'rejected');


-- TABLES
-- R01
CREATE TABLE "user"(
  id SERIAL PRIMARY KEY,
  name TEXT,
  username TEXT UNIQUE NOT NULL,
  search TSVECTOR NOT NULL,
  password TEXT NOT NULL,
  email TEXT UNIQUE NOT NULL,
  about TEXT,
  picture TEXT,
  reputation INTEGER NOT NULL DEFAULT 0
);

-- R02
CREATE TABLE moderator(
  id INTEGER PRIMARY KEY,
  CONSTRAINT fk_user
    FOREIGN KEY(id)
      REFERENCES "user"(id)
);

-- R03
CREATE TABLE administrator(
  id INTEGER PRIMARY KEY,
  CONSTRAINT fk_moderator
    FOREIGN KEY(id)
      REFERENCES moderator(id)
);

-- R04
CREATE TABLE ban(
  id_user INTEGER PRIMARY KEY,
  id_admin INTEGER NOT NULL,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- bans can't have happened in the future
  reason TEXT,
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"(id),
  CONSTRAINT fk_admin
    FOREIGN KEY(id_admin)
      REFERENCES Administrator(id)
);

-- R05
CREATE TABLE news(
  id SERIAL PRIMARY KEY,
  author INTEGER NOT NULL,
  title TEXT NOT NULL,
  subtitle TEXT,
  body TEXT,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- news can't be posted in the future
  CONSTRAINT fk_author
    FOREIGN KEY(author)
      REFERENCES administrator(id)
);

-- R06
CREATE TABLE topic_proposal(
  id SERIAL PRIMARY KEY,
  id_user INTEGER NOT NULL,
  id_admin INTEGER,
  topic_name TEXT NOT NULL,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- proposals can't have happened in the future
  reason TEXT,
  accepted boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"(id),
  CONSTRAINT fk_admin
    FOREIGN KEY(id_admin)
      REFERENCES administrator(id)
);

-- R07
CREATE TABLE achievement(
  id SERIAL PRIMARY KEY,
  title TEXT UNIQUE NOT NULL,
  body TEXT NOT NULL
);

-- R08
CREATE TABLE achieved(
  id_user INTEGER,
  id_achievement INTEGER,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- achievements can't be acquired in the future
  PRIMARY KEY (id_user, id_achievement),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"(id),
  CONSTRAINT fk_achievement
    FOREIGN KEY(id_achievement)
      REFERENCES achievement(id)
);

-- R09
CREATE TABLE post(
  id SERIAL PRIMARY KEY,
  id_owner INTEGER NOT NULL,
  body TEXT NOT NULL,
  score INTEGER NOT NULL DEFAULT 0,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- posts can't be made in the future
  CONSTRAINT fk_owner
    FOREIGN KEY(id_owner)
      REFERENCES "user"(id)
);

-- R10
CREATE TABLE answer(
  id INTEGER PRIMARY KEY,
  CONSTRAINT fk_post
    FOREIGN KEY(id)
      REFERENCES post(id)
);

-- R11
CREATE TABLE question(
  id INTEGER PRIMARY KEY,
  accepted_answer INTEGER,
  title TEXT UNIQUE NOT NULL,
  search TSVECTOR NOT NULL,
  bounty smallint NOT NULL CHECK (
    bounty >= 0
    AND bounty <= 500
  ),
  closed boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_post
    FOREIGN KEY(id)
      REFERENCES post(id),
  CONSTRAINT fk_answer
    FOREIGN KEY(accepted_answer)
      REFERENCES answer(id)
);

-- R12
CREATE TABLE answer_question(
  id_answer INTEGER,
  id_question INTEGER,
  PRIMARY KEY(id_answer, id_question),
  CONSTRAINT fk_answer
    FOREIGN KEY(id_answer)
      REFERENCES answer(id),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question(id)
);

-- R13
CREATE TABLE comment(
  id INTEGER PRIMARY KEY,
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
    FOREIGN KEY(id)
      REFERENCES post(id),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question(id),
  CONSTRAINT fk_answer
    FOREIGN KEY(id_answer)
      REFERENCES answer(id)
);

-- R14
CREATE TABLE vote(
  id_post INTEGER,
  id_user INTEGER,
  value smallint NOT NULL CHECK (
    value = 1
    OR value = -1
  ),
  PRIMARY KEY (id_post, id_user),
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"(id)
);

-- R15
CREATE TABLE edit_proposal(
  id SERIAL PRIMARY KEY,
  id_post INTEGER NOT NULL,
  id_user INTEGER NOT NULL,
  id_moderator INTEGER,
  body TEXT NOT NULL,
  accepted boolean NOT NULL DEFAULT false,
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id),
  CONSTRAINT fk_user
    FOREIGN KEY(id_user)
      REFERENCES "user"(id),
  CONSTRAINT fk_moderator
    FOREIGN KEY(id_moderator)
      REFERENCES moderator(id)
);

-- R16
CREATE TABLE topic(
  id SERIAL PRIMARY KEY,
  name TEXT UNIQUE NOT NULL,
  search TSVECTOR NOT NULL
);

-- R17
CREATE TABLE topic_question(
  id_topic INTEGER,
  id_question INTEGER,
  PRIMARY KEY(id_topic, id_question),
  CONSTRAINT fk_topic
    FOREIGN KEY(id_topic)
      REFERENCES topic(id),
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question(id)
);

-- R18
CREATE TABLE report(
  id_post INTEGER,
  reporter INTEGER,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- reports can't be made in the future
  reason TEXT,
  PRIMARY KEY(id_post, reporter),
  "state" report_state,
  reviewer INTEGER,
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id),
  CONSTRAINT fk_reporter
    FOREIGN KEY(reporter)
      REFERENCES "user"(id),
  CONSTRAINT fk_reviewer
    FOREIGN KEY(reviewer)
      REFERENCES "moderator"(id)
);

-- R19
CREATE TABLE notification(
  id SERIAL PRIMARY KEY,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_DATE), -- can't be notified in the future
  title TEXT NOT NULL,
  body TEXT,
  recipient INTEGER,
  CONSTRAINT fk_recipient
    FOREIGN KEY(recipient)
      REFERENCES "user"(id)
);

-- R20
CREATE TABLE notification_achievement(
  id INTEGER PRIMARY KEY,
  id_achievement INTEGER NOT NULL,
  CONSTRAINT fk_notification
    FOREIGN KEY(id)
      REFERENCES notification(id),
  CONSTRAINT fk_achievement
    FOREIGN KEY(id_achievement)
      REFERENCES achievement(id)
);

-- R21
CREATE TABLE notification_post(
  id INTEGER PRIMARY KEY,
  id_post INTEGER NOT NULL,
  CONSTRAINT fk_notification
    FOREIGN KEY(id)
      REFERENCES notification(id),
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id)
);


-- INDEXES
DROP INDEX IF EXISTS date_idx CASCADE;
DROP INDEX IF EXISTS question_idx CASCADE;
DROP INDEX IF EXISTS owner_idx CASCADE;
DROP INDEX IF EXISTS user_idx CASCADE;
DROP INDEX IF EXISTS state_idx CASCADE;
DROP INDEX IF EXISTS user_search_idx CASCADE;
DROP INDEX IF EXISTS question_search_idx CASCADE;
DROP INDEX IF EXISTS topic_search_idx CASCADE;

CREATE INDEX date_idx ON post USING btree ("date");
CREATE INDEX question_idx ON answer_question USING hash (id_question);
CREATE INDEX owner_idx ON post USING hash (id_owner);
CREATE INDEX user_idx ON achieved USING hash (id_user);
CREATE INDEX state_idx ON report USING hash ("state");
CREATE INDEX user_search_idx ON "user" USING GiST (search);
CREATE INDEX question_search_idx ON question USING GiST (search);
CREATE INDEX topic_search_idx ON topic USING GIN (search);


-- FUNCTIONS
-- used to store the derived attribute 'score' (see comment in vote table)
CREATE OR REPLACE FUNCTION on_score_change()
RETURNS TRIGGER
AS $$
  DECLARE
    val integer;
    post_id integer;
    owner_id integer;
  BEGIN
    IF (TG_OP = 'DELETE') THEN
      post_id := OLD.id_post;
    ELSIF (TG_OP = 'UPDATE') THEN
      post_id := NEW.id_post;
    ELSIF (TG_OP = 'INSERT') THEN
      post_id := NEW.id_post;
    END IF;

    val := (SELECT sum(value)
            FROM post JOIN vote ON (post.id = vote.id_post)
            WHERE id = post_id);

    -- update the question score
    UPDATE post
    SET score = val
    WHERE id = post_id;

    -- update the question's owner reputation
    owner_id := (SELECT id_owner
                  FROM post
                  WHERE id = post_id);

    val := (SELECT count(*)
            FROM post
            JOIN "user" ON (post.id_owner = "user".id)
            WHERE "user".id = owner_id);

    UPDATE "user" as u
    SET reputation = val
    WHERE owner_id = u.id;

    RETURN NULL; -- result is ignored since this is an AFTER trigger
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION user_search_update()
RETURNS TRIGGER
AS $$
  BEGIN
  IF (TG_OP = 'INSERT') THEN
    NEW.search = (setweight(to_tsvector('english', NEW.username), 'A') ||
      setweight(to_tsvector('english', COALESCE(NEW.name, '')), 'B'));
  ELSIF (TG_OP = 'UPDATE') THEN
    IF NEW.username <> OLD.username or NEW.name <> OLD.name THEN
      NEW.search = (setweight(to_tsvector('english', NEW.username), 'A') ||
        setweight(to_tsvector('english', COALESCE(NEW.name, '')), 'B'));
    END IF;
  END IF;

  RETURN NEW;
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION question_search_update()
RETURNS TRIGGER
AS $$
  DECLARE
    b text;
  BEGIN
    -- get the body
    b := (SELECT body
          FROM post
          WHERE post.id = NEW.id);

    IF (TG_OP = 'INSERT') THEN
      NEW.search = (setweight(to_tsvector('english', NEW.title), 'A') || setweight(to_tsvector('english', b), 'B'));
    ELSIF (TG_OP = 'UPDATE') THEN
      IF NEW.title <> OLD.title THEN
        NEW.search = (setweight(to_tsvector('english', NEW.title), 'A') || setweight(to_tsvector('english', b), 'B'));
      END IF;
    END IF;

    RETURN NEW;
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION topic_search_update()
RETURNS TRIGGER
AS $$
  BEGIN
    IF (TG_OP = 'INSERT') THEN
      NEW.search = to_tsvector('english', NEW.name);
    ELSIF (TG_OP = 'UPDATE') THEN
      IF NEW.name <> OLD.name THEN
        NEW.seach = to_tsvector('english', NEW.name);
      END IF;
    END IF;

    RETURN NEW;
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION reopen_question() RETURNS TRIGGER AS
$$
BEGIN
    IF (OLD.closed <> NEW.closed and OLD.closed = TRUE) THEN
      RAISE EXCEPTION 'A closed question can not be re-opened.';
    END IF;
    RETURN NEW;
END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION vote() RETURNS TRIGGER 
AS $$
  DECLARE
    owner integer;
  BEGIN
      owner := (SELECT id_owner FROM post WHERE id = NEW.id_post);
      
      IF (owner = NEW.id_user) THEN
        RAISE EXCEPTION 'A user can not vote on its own post.';
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION notification_generalization() RETURNS TRIGGER 
AS $$
  BEGIN
      IF EXISTS (SELECT * 
        FROM notification_post, notification_achievement  
        WHERE notification_post.id = New.id OR notification_achievement.id = New.id) THEN
        RAISE EXCEPTION 'Notification already exists and must be disjoint.';
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

-- TRIGGERS
DROP TRIGGER IF EXISTS update_score ON vote CASCADE;
CREATE TRIGGER update_score
AFTER DELETE OR INSERT OR UPDATE
ON vote
EXECUTE FUNCTION on_score_change();

DROP TRIGGER IF EXISTS user_search_update_trigger ON "user" CASCADE;
CREATE TRIGGER user_search_update_trigger
BEFORE INSERT OR UPDATE
ON "user"
FOR EACH ROW EXECUTE FUNCTION user_search_update();

DROP TRIGGER IF EXISTS question_search_update_trigger ON question CASCADE;
CREATE TRIGGER question_search_update_trigger
BEFORE INSERT OR UPDATE
ON question
FOR EACH ROW EXECUTE FUNCTION question_search_update();

DROP TRIGGER IF EXISTS topic_search_update_trigger ON topic CASCADE;
CREATE TRIGGER topic_search_update_trigger
BEFORE INSERT OR UPDATE
ON topic
FOR EACH ROW EXECUTE FUNCTION topic_search_update();

DROP TRIGGER IF EXISTS reopen_question_trigger ON question CASCADE;
CREATE TRIGGER reopen_question_trigger
BEFORE UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE reopen_question();

DROP TRIGGER IF EXISTS vote_trigger ON vote CASCADE;
CREATE TRIGGER vote_trigger
BEFORE INSERT OR UPDATE ON vote
FOR EACH ROW
EXECUTE PROCEDURE vote();

DROP TRIGGER IF EXISTS notification_achievement_generalization_trigger ON notification_achievement CASCADE;
CREATE TRIGGER notification_achievement_generalization_trigger
BEFORE INSERT OR UPDATE ON notification_achievement
FOR EACH ROW
EXECUTE PROCEDURE notification_generalization(); 

DROP TRIGGER IF EXISTS notification_post_generalization_trigger ON notification_post CASCADE;
CREATE TRIGGER notification_post_generalization_trigger
BEFORE INSERT OR UPDATE ON notification_post
FOR EACH ROW
EXECUTE PROCEDURE notification_generalization();


-- TRANSACTIONS
--1
-- BEGIN TRANSACTION;
-- INSERT INTO post(id, id_owner, body, "date") VALUES($id, $owner, $body, $date);
-- INSERT INTO question(id, accepted_answer, title, bounty, closed) VALUES($id, NULL, $title, $bounty, $closed);
-- END TRANSACTION;

--2
-- BEGIN TRANSACTION;
-- SELECT COUNT(*) FROM question
-- WHERE id_owner = $user;

-- SELECT * FROM question
-- JOIN post ON(post.id = question.id)
-- WHERE id_owner = $user
-- ORDER BY post."date"
-- LIMIT 10;
-- END TRANSACTION;
