![vi](https://github.com/Gioee/vendite-elettrodomestici/assets/48024736/555d3454-70fd-4f68-93a9-925e1c705e31)

# Appliance Sales

## System identification

This is a sales management system.
The project can be broken down into several parts.
- Management of salespeople who sell home appliances.
- Management of appointments between salespeople and customers.
- Management of customers placing orders.
- Management of products ordered by customers.

## Tech stack

- PHP
- HTML
- JavaScript
- MariaDB
- Bootstrap
- jQuery
- DB Stored pw = SHA256(MD5(Salt)+password)
- Prepared statement to avoid SQL Injection

## Data analysis
Primary keys:
- _matricola_ from Commerciale
- _id_ from Appuntamento
- _CF_ from Cliente
- _codice_ from Prodotto

Foreign keys:
- fkAppMatricola
- fkAppCF
- fkOrdCF
- fkOrdCodice

Project entities:
- Commerciale
- Appuntamento
- Cliente
- Prodotto


## Model construction

### ER model

![image](https://github.com/Gioee/vendite-elettrodomestici/assets/48024736/056d0f3f-094e-494c-98a5-27bc44cd3a22)

Reading Rules:
- Each Commercial may make one or more Appointments, each Appointment must be scheduled by one and only one Commercial.
- Each Appointment must be booked by one and only one Client, each Client may book one or more Appointments.
- Each Customer may order one or more Products, each Product may be ordered by one or more Clients.

### Logical Model.
The M:N relationship is represented by introducing foreign keys into the ordering tables.
Five tables are obtained, even though there are four entities, because there is an N:M relationship.

![image](https://github.com/Gioee/vendite-elettrodomestici/assets/48024736/0a30da21-3025-4400-acc6-2409431b198c)

### Functional Hierarchy Model
This is the graphical, tree-like representation of the hierarchy of subprograms that make up the project.
- Each rectangle represents a subprogram of the project.
- The arcs indicate the flow of data.

![image](https://github.com/Gioee/vendite-elettrodomestici/assets/48024736/394faa71-2ce6-43a9-a9de-db31be5350e5)


