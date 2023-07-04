 A Laravel App. A ticket system where users can assign tickets to suppliers. Tickets contain cost, dates and geographical the location.

> This app is WIP and only contains part of the app. Users and locations still need to be integrated.

## Supplier Listview
Here is a list of suppliers. They can be created and deleted from this view. A supplier can't be deleted when it has been assigned a ticket. See below:
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/4efa9562-b23f-47eb-becd-d4ddea780f45">
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/119fad72-a831-4212-ae5b-cf89ce37bc27">

## Supplier Form
When creating a supplier, here is the basic form provided:
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/5db0a6bd-6df0-46d2-b754-30ac5f2edb4d">

## Ticket Listview
Here is the ticket listview. There are more columns here and more data (it has the same delete functionality as the supplier listview):
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/42942724-1b01-4100-b86a-99f9f83d0028">

## Ticket Form
Here is part one of the form:
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/d9a57133-a2fa-4491-8d5d-571a27e5cb9a">

And part two:
<img width="1440" alt="image" src="https://github.com/BradPhilpott/ticket-app/assets/35923773/e7d425cb-0e21-4de2-a0a8-a2ee14086411">


# Still to do:
- Make dynamic seeders
- Index and check foreign keys for the DB
- Add a user area
- Add a location area
- Assign users to suppliers
- Limit tickets list by the users supplier
- Limit the End Date field on the Ticket form to only have optional dates after the start date
