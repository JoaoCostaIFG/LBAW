-- FUNCTIONS
-- used to store the derived attribute 'score' (see comment in vote table)
CREATE OR REPLACE FUNCTION score()
RETURNS TRIGGER
AS $$
	DECLARE
        val integer;
		post_id integer;
    BEGIN
		IF (TG_OP = 'DELETE') THEN
			val := -OLD.value;
			post_id := OLD.id_post;
        ELSIF (TG_OP = 'UPDATE') THEN
			val := -OLD.value + NEW.value;
			post_id := NEW.id_post;
        ELSIF (TG_OP = 'INSERT') THEN
			val := NEW.value;
			post_id := NEW.id_post;
        END IF;
		
		UPDATE post
		SET score = score + val
		WHERE id = post_id;

		RETURN NULL; -- result is ignored since this is an AFTER trigger
    END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION reputation()
RETURNS TRIGGER
AS $$
    DECLARE
        val integer;
        owner_id integer;
    BEGIN
        IF (TG_OP = 'DELETE') THEN
            val := -OLD.score;
            owner_id := OLD.id_owner;
        ELSIF (TG_OP = 'UPDATE') THEN
            val := -OLD.score + NEW.score;
            owner_id := NEW.id_owner;
        ELSIF (TG_OP = 'INSERT') THEN
            val := NEW.value;
            owner_id := NEW.id_owner;
        END IF;
        
        UPDATE "user"
        SET score = score + val
        WHERE id = owner_id;

        RETURN NULL; -- result is ignored since this is an AFTER trigger
    END;
$$ LANGUAGE plpgsql;

-- TRIGGERS
DROP TRIGGER IF EXISTS update_score ON vote CASCADE;
CREATE TRIGGER update_score
AFTER DELETE OR INSERT OR UPDATE
ON vote
FOR EACH ROW EXECUTE FUNCTION score();

DROP TRIGGER IF EXISTS update_reputation ON post CASCADE;
CREATE TRIGGER update_reputation
AFTER DELETE OR INSERT OR UPDATE
OF score ON post
FOR EACH ROW EXECUTE FUNCTION reputation();
