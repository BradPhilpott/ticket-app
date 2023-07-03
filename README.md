 A Laravel App. A ticket system where users can assign tickets to suppliers. Tickets contain cost, dates and geographical the location.

> This app is WIP and only contains part of the app. Users and locations still need to be integrated.

## Supplier Listview
Here is a list of suppliers. They can be created and deleted from this view. A supplier can't be deleted when it has been assigned a ticket. See below:
<img width="1298" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/d93d2ac3-9fec-4135-bc60-667892c04b79">
<img width="1312" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/a8c2aecf-65fa-415b-aff1-438c844f417a">

## Supplier Form
When creating a supplier, here is the basic form provided:
<img width="1304" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/6fdb38ab-9255-4ff8-82bd-5a10d16fc71e">


## Ticket Listview
Here is the ticket listview. There are more columns here and more data (it has the same delete functionality as the supplier listview):
<img width="1309" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/5f8d63ff-e0e8-4d6d-b007-cef7c0f71772">

## Ticket Form
Here is part one of the form:
<img width="1316" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/491cb0ba-dc94-4896-a496-beca72567b7e">

And part two:
<img width="1330" alt="image" src="https://github.com/BradPhilpott/CD-Task/assets/35923773/459419f4-52f1-4edf-aa66-6231b74d5262">

# Still to do:
- Make dynamic seeders
- Index and check foreign keys for the DB
- Add a user area
- Add a location area
- Assign users to suppliers
- Limit tickets list by the users supplier
- Limit the End Date field on the Ticket form to only have optional dates after the start date
