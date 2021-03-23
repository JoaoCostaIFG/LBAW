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


-- TRIGGERS
CREATE TRIGGER update_score
AFTER UPDATE
ON vote
EXECUTE PROCEDURE score(1);
