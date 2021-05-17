-- CREATE
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
CREATE DOMAIN Today AS TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
CREATE TYPE report_state AS ENUM ('pending', 'approved', 'rejected');


-- TABLES
-- R01
CREATE TABLE "user"(
  id SERIAL PRIMARY KEY,
  name TEXT,
  username TEXT UNIQUE NOT NULL,
  search TSVECTOR,
  password TEXT,
  email TEXT UNIQUE NOT NULL,
  about TEXT,
  picture TEXT,
  reputation INTEGER NOT NULL DEFAULT 0,
  isdeleted boolean NOT NULL DEFAULT false
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- bans can't have happened in the future
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- news can't be posted in the future
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- proposals can't have happened in the future
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- achievements can't be acquired in the future
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- posts can't be made in the future
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
        ON DELETE CASCADE
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
      REFERENCES post(id)
        ON DELETE CASCADE,
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
        ON DELETE CASCADE
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
      REFERENCES post(id)
        ON DELETE CASCADE,
  CONSTRAINT fk_question
    FOREIGN KEY(id_question)
      REFERENCES question(id)
        ON DELETE CASCADE,
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
      REFERENCES post(id)
        ON DELETE CASCADE,
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
      REFERENCES post(id)
        ON DELETE CASCADE,
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
        ON DELETE CASCADE
);

-- R18
CREATE TABLE report(
  id_post INTEGER,
  reporter INTEGER,
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- reports can't be made in the future
  reason TEXT,
  PRIMARY KEY(id_post, reporter),
  "state" report_state,
  reviewer INTEGER,
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id)
        ON DELETE CASCADE,
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
  "date" Today NOT NULL CHECK ("date" <= CURRENT_TIMESTAMP), -- can't be notified in the future
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
      REFERENCES notification(id)
      ON DELETE CASCADE,
  CONSTRAINT fk_achievement
    FOREIGN KEY(id_achievement)
      REFERENCES achievement(id)
      ON DELETE CASCADE
);

-- R21
CREATE TABLE notification_post(
  id INTEGER PRIMARY KEY,
  id_post INTEGER NOT NULL,
  CONSTRAINT fk_notification
    FOREIGN KEY(id)
      REFERENCES notification(id)
      ON DELETE CASCADE,
  CONSTRAINT fk_post
    FOREIGN KEY(id_post)
      REFERENCES post(id)
      ON DELETE CASCADE
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
    val2 integer;
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

    -- update the question score
    val := (SELECT sum(value)
            FROM post JOIN vote ON (post.id = vote.id_post)
            WHERE id = post_id);
    IF val IS NULL THEN
      val := 0;
    END IF;
    UPDATE post
    SET score = val
    WHERE id = post_id;

    -- update the question's owner reputation
    owner_id := (SELECT id_owner
                  FROM post
                  WHERE id = post_id);
    -- score obtaining by votes on the user's posts
    val := (SELECT sum(score)
            FROM post
            JOIN "user" ON (post.id_owner = "user".id)
            WHERE "user".id = owner_id);
    IF val IS NULL THEN
      val := 0;
    END IF;
    -- score obtained by achievements (each is worth 10 reputation)
    val2 := (SELECT count(*)
              FROM "user"
              JOIN achieved ON (achieved.id_user = "user".id)
              JOIN achievement ON (achieved.id_achievement = achievement.id)
              WHERE "user".id = owner_id) * 10;
    UPDATE "user" as u
    SET reputation = val + val2
    WHERE owner_id = u.id;

    RETURN NULL; -- result is ignored since this is an AFTER trigger
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION on_accepting_answer()
RETURNS TRIGGER
AS $$
  DECLARE
    val_delta integer;
    answer_owner_id integer;
  BEGIN
  	val_delta := NEW.bounty;
    IF val_delta IS NULL THEN
      val_delta := 0;
    END IF;
   	answer_owner_id := (SELECT post.id_owner FROM post WHERE post.id = NEW.accepted_answer);

    UPDATE "user" as u
    SET reputation = u.reputation + val_delta
    WHERE answer_owner_id = u.id;

    RETURN NULL; -- result is ignored since this is an AFTER trigger
  END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION on_achievement_change()
RETURNS TRIGGER
AS $$
  DECLARE
    val_delta integer;
    owner_id integer;
  BEGIN
    IF (TG_OP = 'DELETE') THEN
      owner_id := OLD.id_user;
      val_delta = -10;
    ELSIF (TG_OP = 'UPDATE') THEN
      owner_id := NEW.id_user;
      val_delta = 0;
    ELSIF (TG_OP = 'INSERT') THEN
      owner_id := NEW.id_user;
      val_delta = 10;
    END IF;

    UPDATE "user" as u
    SET reputation = u.reputation + val_delta
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
    topics text;
  BEGIN
    -- get the body
    b := (SELECT body
          FROM post
          WHERE post.id = NEW.id);

    -- get the topics
    topics := (SELECT string_agg(name, ' ')
                FROM topic JOIN topic_question ON (topic.id = topic_question.id_topic)
                  JOIN question ON (question.id = topic_question.id_question)
                WHERE question.id = NEW.id);

    IF (TG_OP = 'INSERT' OR TG_OP = 'UPDATE') THEN
      NEW.search = (setweight(to_tsvector('english', NEW.title), 'A') ||
                    setweight(to_tsvector('english', b), 'B') ||
                    setweight(to_tsvector('english', COALESCE(topics, '')), 'C'));
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
        RAISE EXCEPTION 'Notification must be disjoint.';
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION post_generalization() RETURNS TRIGGER
AS $$
  BEGIN
      IF EXISTS (SELECT *
        FROM question, answer, comment
        WHERE question.id = New.id OR answer.id = New.id OR comment.id = New.id) THEN
        RAISE EXCEPTION 'Post must be disjoint.';
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

-- Achievements
CREATE OR REPLACE FUNCTION achievement_first_question() RETURNS TRIGGER
AS $$
  DECLARE
    owner_id integer;
    question_amount integer;
  BEGIN
      owner_id := (SELECT post.id_owner AS owner_id FROM post JOIN question ON(post.id = question.id) WHERE post.id = NEW.id);
      question_amount := (SELECT COUNT(*) FROM post JOIN question ON(post.id = question.id) WHERE post.id_owner = owner_id);

      IF (question_amount = 1) THEN
        IF NOT EXISTS (SELECT * FROM achieved WHERE id_user = owner_id AND id_achievement = 1) THEN
          INSERT INTO achieved(id_user, id_achievement) VALUES (owner_id, 1);
        END IF;
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION achievement_first_accepted_answer() RETURNS TRIGGER
AS $$
  DECLARE
    accepted_answer_id integer;
    answer_owner_id integer;
  BEGIN
    accepted_answer_id := NEW.accepted_answer;

    IF (accepted_answer_id IS NOT NULL) THEN
      answer_owner_id := (SELECT id_owner FROM post WHERE id = accepted_answer_id);
      IF NOT EXISTS (SELECT * FROM achieved WHERE id_user = answer_owner_id AND id_achievement = 2) THEN
        INSERT INTO achieved(id_user, id_achievement) VALUES (answer_owner_id, 2);
      END IF;
    END IF;
    RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION achievement_reputation() RETURNS TRIGGER
AS $$
  BEGIN
    IF (NEW.reputation < 100) THEN
      RETURN NEW;
    END IF;
    IF (NEW.reputation >= 100) THEN
      IF (NOT EXISTS (SELECT * FROM achieved WHERE id_user = New.id AND id_achievement = 3)) THEN
        INSERT INTO achieved(id_user, id_achievement) VALUES (New.id, 3);
      END IF;

      -- Give moderator priveliges
      IF (NOT EXISTS (SELECT * FROM moderator WHERE id = NEW.id)) THEN
        INSERT INTO moderator(id) VALUES(NEW.id);
      END IF;
    END IF;
    IF (NEW.reputation >= 200) THEN
      IF (NOT EXISTS (SELECT * FROM achieved WHERE id_user = New.id AND id_achievement = 4)) THEN
        INSERT INTO achieved(id_user, id_achievement) VALUES (New.id, 4);
      END IF;
    END IF;
    IF (NEW.reputation >= 500) THEN
      IF (NOT EXISTS (SELECT * FROM achieved WHERE id_user = New.id AND id_achievement = 5)) THEN
        INSERT INTO achieved(id_user, id_achievement) VALUES (New.id, 5);
      END IF;
    END IF;
    IF (NEW.reputation >= 1000) THEN
      IF (NOT EXISTS (SELECT * FROM achieved WHERE id_user = New.id AND id_achievement = 6)) THEN
        INSERT INTO achieved(id_user, id_achievement) VALUES (New.id, 6);
      END IF;
    END IF;
    RETURN NEW;
  END
$$
LANGUAGE plpgsql;

-- NOTIFICATIONS
CREATE OR REPLACE FUNCTION add_achievement_notification() RETURNS TRIGGER
AS $$
  BEGIN
      INSERT INTO notification (title, body, recipient) VALUES ('New achievement', 'You have achieved: ', NEW.id_user);
      INSERT INTO notification_achievement (id, id_achievement) VALUES (currval(pg_get_serial_sequence('notification', 'id')), NEW.id_achievement);
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION add_new_answer_notification() RETURNS TRIGGER
AS $$
  BEGIN
      INSERT INTO notification (title, body, recipient) VALUES ('New answer', 'Someone answered your question: ', NEW.id_question);
      INSERT INTO notification_post (id, id_post) VALUES (currval(pg_get_serial_sequence('notification', 'id')), NEW.id_question);
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION add_new_comment_notification() RETURNS TRIGGER
AS $$
  BEGIN
      IF (NEW.id_question IS NOT NULL) THEN
        INSERT INTO notification (title, body, recipient) VALUES ('New Comment', 'Someone commented your question: ', NEW.id_question);
        INSERT INTO notification_post (id, id_post) VALUES (currval(pg_get_serial_sequence('notification', 'id')), NEW.id_question);
      END IF;
      IF (NEW.id_answer IS NOT NULL) THEN
        INSERT INTO notification (title, body, recipient) VALUES ('New Comment', 'Someone commented your answer: ', NEW.id_answer);
        INSERT INTO notification_post (id, id_post) VALUES (currval(pg_get_serial_sequence('notification', 'id')), NEW.id_answer);
      END IF;
      RETURN NEW;
  END
$$
LANGUAGE plpgsql;


-- TRIGGERS

-- Update score
-- on vote
DROP TRIGGER IF EXISTS update_score_vote ON vote CASCADE;
CREATE TRIGGER update_score_vote
AFTER DELETE OR INSERT OR UPDATE ON vote
FOR EACH ROW
EXECUTE FUNCTION on_score_change();
-- on accepting answer
DROP TRIGGER IF EXISTS update_accepting_answer ON question CASCADE;
CREATE TRIGGER update_accepting_answer
AFTER INSERT OR UPDATE OF accepted_answer ON question
FOR EACH ROW
EXECUTE FUNCTION on_accepting_answer();
-- on achievement
DROP TRIGGER IF EXISTS update_score_achievement ON vote CASCADE;
CREATE TRIGGER update_score_achievement
AFTER DELETE OR INSERT OR UPDATE ON achieved
FOR EACH ROW
EXECUTE FUNCTION on_achievement_change();

-- Search user

DROP TRIGGER IF EXISTS user_search_update_trigger ON "user" CASCADE;
CREATE TRIGGER user_search_update_trigger
BEFORE INSERT OR UPDATE ON "user"
FOR EACH ROW
EXECUTE FUNCTION user_search_update();

-- Search question

DROP TRIGGER IF EXISTS question_search_update_trigger ON question CASCADE;
CREATE TRIGGER question_search_update_trigger
BEFORE INSERT OR UPDATE ON question
FOR EACH ROW
EXECUTE FUNCTION question_search_update();

-- Search topic

DROP TRIGGER IF EXISTS topic_search_update_trigger ON topic CASCADE;
CREATE TRIGGER topic_search_update_trigger
BEFORE INSERT OR UPDATE ON topic
FOR EACH ROW
EXECUTE FUNCTION topic_search_update();

-- Reopen question

DROP TRIGGER IF EXISTS reopen_question_trigger ON question CASCADE;
CREATE TRIGGER reopen_question_trigger
BEFORE UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE reopen_question();

-- Can't vote on their own post

DROP TRIGGER IF EXISTS vote_trigger ON vote CASCADE;
CREATE TRIGGER vote_trigger
BEFORE INSERT OR UPDATE ON vote
FOR EACH ROW
EXECUTE PROCEDURE vote();

-- Notification Generalization

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

--- Post generalization

DROP TRIGGER IF EXISTS post_answer_generalization_trigger ON answer CASCADE;
CREATE TRIGGER post_answer_generalization_trigger
BEFORE INSERT OR UPDATE ON answer
FOR EACH ROW
EXECUTE PROCEDURE post_generalization();

-- This trigger cannot be run on update because when we want to set or change the accepted answer it will not allow it
DROP TRIGGER IF EXISTS post_question_generalization_trigger ON question CASCADE;
CREATE TRIGGER post_question_generalization_trigger
BEFORE INSERT ON question
FOR EACH ROW
EXECUTE PROCEDURE post_generalization();

DROP TRIGGER IF EXISTS post_comment_generalization_trigger ON comment CASCADE;
CREATE TRIGGER post_comment_generalization_trigger
BEFORE INSERT OR UPDATE ON comment
FOR EACH ROW
EXECUTE PROCEDURE post_generalization();

DROP RULE IF EXISTS remove_user ON "user" CASCADE;
CREATE RULE remove_user
AS ON DELETE TO "user"
DO INSTEAD(
    UPDATE "user"
    SET
      name = 'Deleted User' || Old.id,
      username = 'DeletedUser' || Old.id,
      search = to_tsvector(''),
      password = NULL,
      email = 'deleteduser' || Old.id || '@segmentationfault.com',
      about = NULL,
      picture = NULL,
      reputation = 0
    WHERE id = Old.id;
    DELETE FROM "achieved" WHERE id_user = Old.id;
    DELETE FROM "notification" WHERE id = Old.id;
);

---- Achievements

DROP TRIGGER IF EXISTS achievement_first_question_trigger ON question CASCADE;
CREATE TRIGGER achievement_first_question_trigger
AFTER INSERT ON question
FOR EACH ROW
EXECUTE PROCEDURE achievement_first_question();

DROP TRIGGER IF EXISTS achievement_first_accepted_answer_trigger ON question CASCADE;
CREATE TRIGGER achievement_first_accepted_answer_trigger
AFTER INSERT OR UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE achievement_first_accepted_answer();

DROP TRIGGER IF EXISTS achievement_reputation_trigger ON "user" CASCADE;
CREATE TRIGGER achievement_reputation_trigger
AFTER INSERT OR UPDATE ON "user"
FOR EACH ROW
EXECUTE PROCEDURE achievement_reputation();

---- NOTIFICATIONS

DROP TRIGGER IF EXISTS add_achievement_notification ON achieved CASCADE;
CREATE TRIGGER add_achievement_notification
AFTER INSERT ON achieved
FOR EACH ROW
EXECUTE PROCEDURE add_achievement_notification();

DROP TRIGGER IF EXISTS add_new_answer_notification ON answer_question CASCADE;
CREATE TRIGGER add_new_answer_notification
AFTER INSERT ON answer_question
FOR EACH ROW
EXECUTE PROCEDURE add_new_answer_notification();

DROP TRIGGER IF EXISTS add_new_comment_notification ON comment CASCADE;
CREATE TRIGGER add_new_comment_notification
AFTER INSERT ON comment
FOR EACH ROW
EXECUTE PROCEDURE add_new_comment_notification();

-- TRANSACTIONS
CREATE OR REPLACE PROCEDURE create_question
(
  OwnerUser INT,
  Body TEXT,
  DatePost TIMESTAMP,
  Title TEXT,
  Bounty INT,
  Closed BOOLEAN
)
LANGUAGE plpgsql
AS
$$
DECLARE
  rep integer;
  inserted_id integer;
BEGIN
  rep := (SELECT "user".reputation FROM "user" WHERE id = OwnerUser);
  IF rep < Bounty THEN
    RAISE EXCEPTION 'User has smaller reputation (%) than the question bounty (%)', rep, Bounty;
  END IF;

  UPDATE "user" SET reputation = rep - Bounty WHERE id = OwnerUser;

  INSERT INTO post(id_owner, body, "date") VALUES(OwnerUser, Body, DatePost)
    RETURNING id INTO inserted_id;
  -- INSERT INTO question(id, accepted_answer, title, bounty, closed) SELECT(1, NULL, Title, Bounty, Closed);
  INSERT INTO question(id, accepted_answer, title, bounty, closed)
  	VALUES (inserted_id, NULL, Title, Bounty, Closed);
END
$$;

CREATE OR REPLACE PROCEDURE create_comment
(
  OwnerUser INT,
  Body TEXT,
  DatePost TIMESTAMP,
  IdQuestion INT,
  IdAnswer INT
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  INSERT INTO post(id_owner, body, "date") VALUES(OwnerUser, Body, DatePost);
  -- INSERT INTO question(id, accepted_answer, title, bounty, closed) SELECT(1, NULL, Title, Bounty, Closed);
  INSERT INTO comment(id, id_question, id_answer) VALUES (currval(pg_get_serial_sequence('post','id')), IdQuestion, IdAnswer);
END
$$;

CREATE OR REPLACE PROCEDURE create_answer
(
  OwnerUser INT,
  Body TEXT,
  DatePost TIMESTAMP,
  IdQuestion INT
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  INSERT INTO post(id_owner, body, "date") VALUES(OwnerUser, Body, DatePost);
  -- INSERT INTO question(id, accepted_answer, title, bounty, closed) SELECT(1, NULL, Title, Bounty, Closed);
  INSERT INTO answer(id) VALUES (currval(pg_get_serial_sequence('post','id')));
  INSERT INTO answer_question(id_answer, id_question) VALUES(currval(pg_get_serial_sequence('post','id')), IdQuestion);
END
$$;

CREATE OR REPLACE PROCEDURE create_moderator
(
  Name TEXT,
  Username TEXT,
  Password TEXT,
  Email TEXT,
  About TEXT,
  Picture TEXT
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  INSERT INTO "user" (name, username, password, email, about, picture) VALUES(Name, Username, Password, Email, About, Picture);
  INSERT INTO moderator (id) VALUES(currval(pg_get_serial_sequence('user','id')));
END
$$;

CREATE OR REPLACE PROCEDURE create_admin
(
  Name TEXT,
  Username TEXT,
  Password TEXT,
  Email TEXT,
  About TEXT,
  Picture TEXT
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  INSERT INTO "user" (name, username, password, email, about, picture) VALUES(Name, Username, Password, Email, About, Picture);
  INSERT INTO moderator (id) VALUES(currval(pg_get_serial_sequence('user','id')));
  INSERT INTO administrator (id) VALUES(currval(pg_get_serial_sequence('user','id')));
END
$$;

CREATE OR REPLACE PROCEDURE ban_user
(
  idUser INT,
  idAdmin INT,
  date TEXT,
  reason TEXT
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  DELETE FROM "user" WHERE id=idUser;
  INSERT INTO ban(id_user, id_admin, "date", reason) VALUES(idUser, idAdmin, date, reason);
END
$$;




-- POPULATE

-- R01
insert into "user" (name, username, password, email, about, picture) values
  ('Torrance Jerrom', 'tjerrom0', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'tjerrom0@deliciousdays.com', 'Dental Hygienist', 'default.jpg'),
  ('Keenan O''Bruen', 'kobruen1', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'kobruen1@yolasite.com', 'Tax Accountant', 'default.jpg'),
  ('Joey Kores', 'jkores2', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'jkores2@parallels.com', 'Administrative Officer', 'default.jpg'),
  ('Berky Shakespeare', 'bshakespeare3', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'bshakespeare3@deliciousdays.com', 'Biostatistician IV', 'default.jpg'),
  ('Ives Shinn', 'ishinn4', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'ishinn4@topsy.com', 'Programmer Analyst IV', 'default.jpg'),
  ('Ian Franklyn', 'ifranklyn5', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'ifranklyn5@oracle.com', 'Senior Quality Engineer', 'default.jpg'),
  ('Pernell Danelut', 'pdanelut6', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'pdanelut6@shareasale.com', 'Marketing Manager', 'default.jpg'),
  ('Malachi Rilings', 'mrilings7', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'mrilings7@tinypic.com', 'Nurse', 'default.jpg'),
  ('Gill Lehrian', 'glehrian8', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'glehrian8@sina.com.cn', 'Junior Executive', 'default.jpg'),
  ('Baily Bernet', 'bbernet9', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'bbernet9@weather.com', 'Chemical Engineer', 'default.jpg'),
  ('Miner Abazi', 'mabazia', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'mabazia@mashable.com', 'Payment Adjustment Coordinator', 'default.jpg'),
  ('Kleon Olech', 'kolechb', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'kolechb@studiopress.com', 'Environmental Specialist', 'default.jpg'),
  ('Emmy Sisley', 'esisleyc', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'esisleyc@noaa.gov', 'Account Representative II', 'default.jpg'),
  ('Olav Zanetto', 'ozanettod', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'ozanettod@hostgator.com', 'Senior Developer', 'default.jpg'),
  ('Paulina Habbeshaw', 'phabbeshawe', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'phabbeshawe@time.com', 'Librarian', 'default.jpg'),
  ('Karil Peoples', 'kpeoplesf', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'kpeoplesf@behance.net', 'Occupational Therapist', 'default.jpg'),
  ('Daisi Worters', 'dwortersg', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'dwortersg@icio.us', 'Help Desk Operator', 'default.jpg'),
  ('Cathee Carthy', 'ccarthyh', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'ccarthyh@twitter.com', 'Senior Quality Engineer', 'default.jpg'),
  ('Dusty Maxwaile', 'dmaxwailei', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'dmaxwailei@google.nl', 'Systems Administrator II', 'default.jpg'),
  ('Tybalt Russan', 'trussanj', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'trussanj@linkedin.com', 'Editor', 'default.jpg'),
  ('Rhona Kemmett', 'rkemmettk', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'rkemmettk@lulu.com', 'Information Systems Manager', 'default.jpg'),
  ('Rubetta Molesworth', 'rmolesworthl', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'rmolesworthl@hexun.com', 'Geologist I', 'default.jpg'),
  ('Magdaia Volcker', 'mvolckerm', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'mvolckerm@bluehost.com', 'VP Product Management', 'default.jpg'),
  ('Eleen Bullin', 'ebullinn', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'ebullinn@vk.com', 'Software Engineer IV', 'default.jpg'),
  ('Anallese Thoma', 'athomao', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'athomao@flickr.com', 'Research Assistant III', 'default.jpg'),
  ('Gib Kipping', 'gkippingp', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'gkippingp@joomla.org', 'Operator', 'default.jpg'),
  ('Jasun Deverock', 'jdeverockq', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'jdeverockq@addthis.com', 'Statistician IV', 'default.jpg'),
  ('Jodee Burmaster', 'jburmasterr', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'jburmasterr@foxnews.com', 'Biostatistician I', 'default.jpg'),
  ('Glynn Baytrop', 'gbaytrops', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'gbaytropj,s@ed.gov', 'Sales Representative', 'default.jpg'),
  ('Zilvia Marvell', 'zmarvellt', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'zmarvellt@cbslocal.com', 'Senior Quality Engineer', 'default.jpg'),
  ('1', '1', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', '1', '1', 'default.jpg'),
  ('admin', 'admin', '$2y$10$VTbK/xpteDPvaoxGuuyN8ulxU26mz/xJEwlE.Wx724.xGwou4tjzO', 'admin', 'admin', 'default.jpg');

-- R02
insert into moderator (id) values (1), (2), (3), (32);

-- R03
insert into administrator (id) values (1), (32);

-- R04
insert into ban (id_user, id_admin, "date", reason) values
  (10, 1, '2021-03-23', 'Verbal abuse.'),
  (11, 1, '2021-03-22', 'Racist comments.');

-- R05
insert into news (id, author, title, subtitle, body, date) values
  (1, 1, 'Hello and welcome.', 'The website is open.', 'You can now join and use our community.', '2021-03-15'),
  (2, 1, 'We have reached 100 members.', 'Our community is growing.', 'Thank you everyone for trusting us.', '2021-03-15');

-- R06
INSERT INTO topic_proposal (id_user, id_admin, topic_name, "date", reason, accepted) VALUES
  (3, NULL, 'zig', '2020-03-28', 'interesting language', false),
  (3, NULL, 'bazinga', '2021-03-03', 'big bog theorom', false),
  (1, 1, 'c++', '2020-01-11','i like c plus plus', false);

-- R07
INSERT INTO achievement(id, title, body) VALUES
  (1, 'Post first question', 'You posted your first question on Segmentation Fault'),
  (2, 'Get first accepted answer', 'An answer you posted was chosen as the accepted answer'),
  (3, 'Reached 100 reputation', 'You have reached 100 reputation! Thank you for your contribution'),
  (4, 'Reached 200 reputation', 'You have reached 200 reputation! Thank you for your contribution'),
  (5, 'Reached 500 reputation', 'You have reached 500 reputation! Thank you for your contribution'),
  (6, 'Reached 1000 reputation', 'You have reached 1000 reputation! Thank you for your contribution');

UPDATE "user" SET reputation = 550 WHERE id = 1;
UPDATE "user" SET reputation = 1050 WHERE id = 2;
UPDATE "user" SET reputation = 150 WHERE id = 3;
UPDATE "user" SET reputation = 700 WHERE id = 5;
UPDATE "user" SET reputation = 100 WHERE id = 12;

-- CREATE OR REPLACE PROCEDURE create_question(OwnerUser INT, Body TEXT, DatePost DATE, Title TEXT, Bounty INT, Closed BOOLEAN)
-- CREATE OR REPLACE PROCEDURE create_answer(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT)
-- CREATE OR REPLACE PROCEDURE create_comment(OwnerUser INT, Body TEXT, DatePost DATE, IdQuestion INT, IdAnswer INT)
CALL create_question(1, 'If Python does not have a ternary conditional operator, is it possible to simulate one using other language constructs?', TIMESTAMP '2008-12-17 00:00:00', 'Does Python have a ternary conditional operator?', 0, true);
CALL create_comment(2, 'In the Python 3.0 official documentation referenced in a comment above, this is referred to as "conditional_expressions" and is very cryptically defined. That documentation doesn''t even include the term "ternary", so you would be hard-pressed to find it via Google unless you knew exactly what to look for. The version 2 documentation is somewhat more helpful and includes a link to "PEP 308", which includes a lot of interesting historical context related to this question.', TIMESTAMP '2013-01-10 00:00:00', 1, NULL);
CALL create_answer(3, '<expression 2> if <condition> else <expression 1>', TIMESTAMP '2010-05-27 00:00:00', 1);
CALL create_comment(4, 'This one emphasizes the primary intent of the ternary operator: value selection. It also shows that more than one ternary can be chained together into a single expression.', TIMESTAMP '2010-10-04 00:00:00', NULL, 3);
CALL create_question(5, 'What is the difference between a function decorated with @staticmethod and one decorated with @classmethod?', TIMESTAMP '2008-09-25 00:00:00', 'Difference between staticmethod and classmethod', 50, false);
CALL create_comment(6, 'tl;dr >> when compared to normal methods, the static methods and class methods can also be accessed using the class but unlike class methods, static methods are immutable via inheritance.', TIMESTAMP '2018-07-11 00:00:00', 5, NULL);
CALL create_answer(7, 'Basically @classmethod makes a method whose first argument is the class it''s called from (rather than the class instance), @staticmethod does not have any implicit arguments.',TIMESTAMP '2008-09-25 00:00:00', 5);
CALL create_answer(8, '@classmethod : can be used to create a shared global access to all the instances created of that class..... like updating a record by multiple users.... I particulary found it use ful when creating singletons as well..:)\n@static method: has nothing to do with the class or instance being associated with ...but for readability can use static method', TIMESTAMP '2017-09-20 00:00:00', 5);
CALL create_question(9, 'If Python does not have a ternary conditional operator, is it possible to simulate one using other language constructs?', '2008-12-17 00:00:00', 'How can I remove a specific item from an array?', 0, true);
CALL create_answer(10, 'Find the index of the array element you want to remove using indexOf, and then remove that index with splice.', TIMESTAMP '2011-04-23 00:00:00', 9);
CALL create_comment(11, 'Serious question: why doesn''t JavaScript allow the simple and intuitive method of removing an element at an index? A simple, elegant, myArray.remove(index); seems to be the best solution and is implemented in many other languages (a lot of them older than JavaScript.)', TIMESTAMP '2020-09-10 00:00:00', NULL, 10);
CALL create_question(12, 'I have an array of numbers and I''m using the .push() method to add elements to it.\nIs there a simple way to remove a specific element from an array?\nI''m looking for the equivalent of something like:\narray.remove(number);\nI have to use core JavaScript. Frameworks are not allowed.', TIMESTAMP '2011-04-23 00:00:00', 'How to use non-packaged Python code from GitHub?', 30, false);
CALL create_answer(13, 'That repository doesn''t seem to be properly packaged for library use at all. I''d recommend forking it, making the changes you need to make it usable (moving the files into a package, adding a setup.py) and then using that as a git+https:// style requirement.', TIMESTAMP '2021-03-28 00:00:00', 12);
CALL create_comment(14, 'Exactly, the repo is also under an MIT License, which really even allows keeping the source files in the project directly.', TIMESTAMP '2021-03-28 00:00:00', 12, NULL);
CALL create_question(15, 'How do you set, clear, and toggle a bit?', TIMESTAMP '2019-08-22 00:00:00', 'How do you set, clear, and toggle a single bit?', 0, true);
CALL create_answer(16, 'Use the bitwise OR operator (|) to set a bit.', TIMESTAMP '2020-09-20 00:00:00', 15);
CALL create_comment(17, 'You are very dumb haha',TIMESTAMP '2020-09-20 00:00:00', 15, NULL);
CALL create_question(1, 'How do you post a question', TIMESTAMP '2019-08-22 00:00:00', 'is it here?', 0, false);
CALL create_answer(1, 'Someone delete this please', TIMESTAMP '2021-02-21 00:00:00', 18);

UPDATE question SET accepted_answer = 3 WHERE id = 1;
UPDATE question SET accepted_answer = 10 WHERE id = 9;
UPDATE question SET accepted_answer = 16 WHERE id = 15;

-- R14
INSERT INTO vote(id_post, id_user, value) VALUES
  (1, 2, -1),
  (1, 3, 1),
  (1, 4, -1),
  (3, 6, 1),
  (3, 7, -1),
  (5, 10, 1),
  (5, 15, 1),
  (5, 11, 1);

-- R15
INSERT INTO edit_proposal(id_post, id_user, id_moderator, body, accepted) VALUES
  (3, 5, NULL, '<expression 1> if <condition> else <expression 2>', false),
  (2, 2, NULL, 'Example Proposal', false);


-- R16
INSERT INTO topic (name) VALUES ('cpp');
INSERT INTO topic (name) VALUES ('python');
INSERT INTO topic (name) VALUES ('javascript');
INSERT INTO topic (name) VALUES ('c');
INSERT INTO topic (name) VALUES ('sql');
INSERT INTO topic (name) VALUES ('prolog');

--R17
INSERT INTO topic_question (id_topic, id_question) VALUES (2, 1);
INSERT INTO topic_question (id_topic, id_question) VALUES (2, 5);
INSERT INTO topic_question (id_topic, id_question) VALUES (3, 9);
INSERT INTO topic_question (id_topic, id_question) VALUES (2, 12);
INSERT INTO topic_question (id_topic, id_question) VALUES (1, 15);
INSERT INTO topic_question (id_topic, id_question) VALUES (4, 15);
INSERT INTO topic_question (id_topic, id_question) VALUES (1, 18);
INSERT INTO topic_question (id_topic, id_question) VALUES (2, 18);
INSERT INTO topic_question (id_topic, id_question) VALUES (6, 18);

-- R18
INSERT INTO report (id_post, reporter, "date", reason, state, reviewer) VALUES
  (2, 1, '2020-07-29', 'He called me dumb', 'pending', 2),
  (7, 5, '2021-01-09', 'He called me not cool', 'pending', 2),
  (10, 10, '2020-09-20', 'He was bad', 'approved', 2),
  (15, 15, '2020-11-12', 'He is sheldon cooper', 'rejected', 2);
