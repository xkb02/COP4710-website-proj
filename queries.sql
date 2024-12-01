/* 1.  */
SELECT H.address
FROM House H
JOIN Listings L ON H.address = L.address;

/* 2.  */
SELECT H.address, L.mlsNumber
FROM House H
JOIN Listings L ON H.address = L.address;

/* 3.  */
SELECT H.address
FROM House H
JOIN Listings L ON H.address = L.address
WHERE H.bedrooms = 3 AND H.bathrooms = 2;

/* 4.  */
SELECT H.address, P.price
FROM House H
JOIN Listings L ON H.address = L.address
JOIN Property P ON H.address = P.address
WHERE H.bedrooms = 3 
AND H.bathrooms = 2
AND P.price BETWEEN 100000 AND 250000
ORDER BY P.price DESC;

/* 5.  */
SELECT P.address, P.price
FROM Property P
JOIN Business_Property B ON P.address = B.address
WHERE B.type = 'Office Space'
ORDER BY P.price DESC;

/* 6.  */
SELECT A.agentId, A.name, A.phone, F.name AS firm_name, A.dateStarted
FROM Agent A
JOIN Firm F ON A.firmId = F.id;

/* 7.  */
SELECT P.address, P.price, L.dateListed
FROM Property P
JOIN Listings L ON P.address = L.address
WHERE L.agentId = 1;

/* 8. */
SELECT A.name AS agent_name, B.name AS buyer_name
FROM Agent A
JOIN Works_With W ON A.agentId = W.agentId
JOIN Buyer B ON W.buyerId = B.id
ORDER BY A.name;

/* 9. */
SELECT A.agentId, A.name, COUNT(W.buyerId) as buyer_count
FROM Agent A
LEFT JOIN Works_With W ON A.agentId = W.agentId
GROUP BY A.agentId, A.name;

/* 10.  */
SELECT P.address, P.price, H.bedrooms, H.bathrooms
FROM Property P
JOIN House H ON P.address = H.address
JOIN Buyer B ON B.id = 1
WHERE B.propertyType = 'House'
AND (B.bedrooms IS NULL OR H.bedrooms = B.bedrooms)
AND (B.bathrooms IS NULL OR H.bathrooms = B.bathrooms)
AND P.price BETWEEN B.minimumPreferredPrice AND B.maximumPreferredPrice
ORDER BY P.price DESC;
