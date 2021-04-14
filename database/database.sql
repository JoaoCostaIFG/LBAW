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
  username TEXT UNIQUE,
  search TSVECTOR,
  password TEXT,
  email TEXT UNIQUE,
  about TEXT,
  picture TEXT,
  reputation INTEGER DEFAULT 0
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

DROP TRIGGER IF EXISTS update_score ON vote CASCADE;
CREATE TRIGGER update_score
AFTER DELETE OR INSERT OR UPDATE
ON vote
EXECUTE FUNCTION on_score_change();

-- Search user

DROP TRIGGER IF EXISTS user_search_update_trigger ON "user" CASCADE;
CREATE TRIGGER user_search_update_trigger
BEFORE INSERT OR UPDATE
ON "user"
FOR EACH ROW EXECUTE FUNCTION user_search_update();

-- Search question

DROP TRIGGER IF EXISTS question_search_update_trigger ON question CASCADE;
CREATE TRIGGER question_search_update_trigger
BEFORE INSERT OR UPDATE
ON question
FOR EACH ROW EXECUTE FUNCTION question_search_update();

-- Search topic

DROP TRIGGER IF EXISTS topic_search_update_trigger ON topic CASCADE;
CREATE TRIGGER topic_search_update_trigger
BEFORE INSERT OR UPDATE
ON topic
FOR EACH ROW EXECUTE FUNCTION topic_search_update();

-- Reopen question

DROP TRIGGER IF EXISTS reopen_question_trigger ON question CASCADE;
CREATE TRIGGER reopen_question_trigger
BEFORE UPDATE ON question
FOR EACH ROW
EXECUTE PROCEDURE reopen_question();

-- Vote on its own post

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
DO INSTEAD
    UPDATE "user"
    SET
      name = 'Deleted User',
      username = NULL,
      search = '',
      password = NULL,
      email = NULL,
      about = NULL,
      picture = NULL,
      reputation = NULL
    WHERE id = Old.id;

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
  DatePost DATE,
  Title TEXT,
  Bounty INT,
  Closed BOOLEAN
)
LANGUAGE plpgsql
AS
$$
DECLARE
BEGIN
  INSERT INTO post(id_owner, body, "date") VALUES(OwnerUser, Body, DatePost);
  -- INSERT INTO question(id, accepted_answer, title, bounty, closed) SELECT(1, NULL, Title, Bounty, Closed);
  INSERT INTO question(id, accepted_answer, title, bounty, closed) 
  	VALUES (currval(pg_get_serial_sequence('post','id')), NULL, Title, Bounty, Closed);
END
$$;

CREATE OR REPLACE PROCEDURE create_comment
(
  OwnerUser INT,
  Body TEXT,
  DatePost DATE,
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
  DatePost DATE,
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
  INSERT INTO "user" (name, username, password, email, about, picture) VALUES(Name, Username, Password, Email, About, Picture)
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
  INSERT INTO "user" (name, username, password, email, about, picture) VALUES(Name, Username, Password, Email, About, Picture)
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