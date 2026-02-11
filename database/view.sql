-- Create a view to list all exchanges with user and object details
CREATE VIEW exchanges_with_details AS
SELECT 
    e.id AS exchange_id,
    e.status,
    e.created_at AS exchange_created_at,
    u1.username AS user1_username,
    u1.email AS user1_email,
    u2.username AS user2_username,
    u2.email AS user2_email,
    o1.name AS object1_name,
    o1.description AS object1_description,
    o1.price AS object1_price,
    o2.name AS object2_name,
    o2.description AS object2_description,
    o2.price AS object2_price
FROM exchange e
JOIN users u1 ON e.user1_id = u1.id
JOIN users u2 ON e.user2_id = u2.id
JOIN object o1 ON e.object1_id = o1.id
JOIN object o2 ON e.object2_id = o2.id;

-- view all exchanges of specific user
-- To view all exchanges for a specific user, replace ? with the user_id
SELECT * FROM exchanges_with_details 
WHERE user1_id = ? OR user2_id = ?;

-- view all images of specific object
-- To view all images for a specific object, replace ? with the object_id
SELECT * FROM image WHERE object_id = ?;