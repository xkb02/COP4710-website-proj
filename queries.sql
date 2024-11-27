SELECT L.address, L.mlsNumber
FROM Listings L
JOIN House H ON L.address = H.address;

SELECT P.address, P.price
FROM Property P
JOIN House H ON P.address = H.address
WHERE H.bedrooms = 3 AND H.bathrooms = 2
AND P.price BETWEEN 100000 AND 250000
ORDER BY P.price DESC;

SELECT A.name AS agentName, B.name AS buyerName
FROM Works_With W
JOIN Agent A ON W.agentId = A.agentId
JOIN Buyer B ON W.buyerId = B.id
ORDER BY A.name;

SELECT A.agentId, A.name AS agentName, A.phone, F.name AS firmName, A.dateStarted
FROM Agent A
JOIN Firm F ON A.firmId = F.id;

SELECT A.name AS agentName, B.name AS buyerName
FROM Works_With W
JOIN Agent A ON W.agentId = A.agentId
JOIN Buyer B ON W.buyerId = B.id
ORDER BY A.name;

SELECT P.address, P.price
FROM Property P
JOIN House H ON P.address = H.address
JOIN Buyer B ON B.id = 1
WHERE B.propertyType = 'House'
AND (B.bedrooms IS NULL OR H.bedrooms = B.bedrooms)
AND (B.bathrooms IS NULL OR H.bathrooms = B.bathrooms)
AND P.price BETWEEN B.minimumPreferredPrice AND B.maximumPreferredPrice
ORDER BY P.price DESC;
