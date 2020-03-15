# A2: Actors and User stories

The project consists in developing a global marketplace which specializes in the sale of gaming related digital products using redemption keys.
 
This artefact contais the specification of the actors and their user stories, it also serves as a lightweight documentation of the project's requirements and business rules.


## 1. Actors
![](https://i.imgur.com/Wu96gY4.png)


###### Picture 1: Diagram identifying actors and their relationships.


| Identifier| Description| Examples|
| ------------------------- |:-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------- |
|User| Generic user. Has access to public information such as products on discount, sellers reviews and feedback.| n/a|
|Unauthenticated User| Has the ability to sign up and login into the website.| n/a|
|Authenticated User| Is capable of logging out, managing their personal account information and buy and sell products.| nightwalker739 |
|Buyer| Has the ability to buy, review and report sellers of purchased products. | nightwalker739|
|Seller| Is capable of listing products for sale. | nightwalker739|
|Banned User| Is banned from making new transactions, whether it is selling or buying, but still has access to past transactions' details.| trustlessuser123|
|Administrator| Has the capacity to delete offensive reviews, update products' details, block certain users from selling and buying games, add games to the database, manage the reports made by users. | admin |
|API User| External user that has the possibility to obtain and change information on the website using GET and POST HTTP requests.| External User|
|Paypal Sandbox API| Allows the user to use PayPal as a payment method to buy products onthe website.| Paypal Email and Password |
|Google Authentication API | Allows the user to sign in with their own google account into the website.| Google Email and Password|

###### Table 1: Actor's description and examples

# Atualizar esta tabela

## 2. User Stories

### 2.1. User


| Identifier | Name| Priority | Description|
| ---------- | -------------------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------------- |
|US01| Search Product|High| As a user, I want to search for a specific product by name, so that I can easily access the product I'm looking for.|
|US02|Search Filters|High| As a user, I want to restrict categories, genres and platforms of a search's results, so that I can search for results of my interest.|
|US03|View Product|High| As a user, I want to view products details, so that I can buy the product I desire.|
|US04|View Shopping Cart|High| As a user, I want to view my shopping cart content anywhere in the website, so that I can checkout and manage it content.|
|US05|Sort Search Results|Medium| As a user, I want to sort the list of products by price, date of release, popularity, so that I can more easily find desired products.|
|US06|View Seller Reviews|Medium|As a user, I want to see the sellers reviews and feedback, so that I am aware if the seller is trusted.|
|US07|Manage Shooping Cart Items|Medium| As a user, I want to be able to view, add and remove items from a shopping cart so that my checkout won't include any undesired item.|
|US08|View Seller Profile|Medium| As a user, I want to be able to view seller profile page, so that I can access his contact information.|
|US09|Save Shooping Cart Items|Low|As a user, I want my shopping cart to keep previously selected items, so that when I exit and comeback to the website the shopping cart remains the same.|
|US10|FAQ|Low|As a user, I want to access the FAQ page, so that I can clarify some of my questions.|
|US11|View Discounts|Low| As a user, I want to view the products that are on discount, so that I can see if a product that I am interested in has a lower price.|

###### Table 2: User's user stories

### 2.2. Unauthenticated User

|Identifier | Name | Priority | Description|
| ---------- | ---- | -------- | --- |
|US12| Sign Up | High | As an unauthenticated User, I want to be able to sign up, so that I can be an authenticated user.|
|US13| Login | High | As an unauthenticated User, I want to be able to login, so that I can have the privileges of an authenticated user.|
|US14| Sign Up Using External API |Low| As an unauthenticated User, I want to be authenticated using an google account, so that I don't have to fill the sign up form.|
|US15| Login Using External API | Low | As an unauthenticated User, I want to be authenticated using an google account, so that I don't have to fill the login form.|

###### Table 3: Unauthenticated User's user stories

### 2.3. Authenticated User

| Identifier |Name| Priority | Description|
| ---------- | ------------------------------ | -------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|US16|Logout|High| As an authenticated user, I want to be able to logout of the website so that I'm no longer logged in.|
|US17| Account Deletion| High| As an authenticated user, I want to be able to delete my account, so that I am no longer related with the website.|
|US18|Edit Profile|Medium|As an authenticated user, I want to be able to manage my personal account information, so that I can update my personal information.
|US19| Purchases History|Medium| As an authenticated user, I want to see my past purchases, so that I know the details of each purchase.|
|US20| Sales History| Medium   | As an authenticated user, I want to view all my past sales, so that I can see which products I have sold.|
|US21| Shopping Cart Preservation| Medium| As an authenticated user, I want the items that I had in my shopping cart before loging on preserve it state after login successful, so that I do not need to select them again.|

###### Table 4: Authenticated User's user stories

### 2.4. Buyer

| Identifier |Name| Priority | Description|
| ---------- | ----------------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------------ |
|US22|Report Transaction Problem|Medium|As a buyer, I want to be able to report a problem with a key I bought, so that the seller and administrators are made aware of the situation.|
|US23|Transaction Feedback|Medium| As an authenticated user, I want to be able to give feedback to the Seller of a product I bought.|
|US24| Checkout Cart|Medium| As a buyer, I want to be able to checkout my cart, so that I buy all the items in the shopping cart at once.|
|US25| Pay Transactions using PayPal |Low| As a buyer, I want to be able to buy using PayPal, so that I use a secure payment method.|




###### Table 5: Buyer's user stories

### 2.5. Seller

| Identifier |Name| Priority | Description|
| ---------- | ----------------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------------ |
|US26|Sell Product|High|As a seller, I want to place an offer for a given product that I chose from the ones available in the website's database, so that I am able to sell it.|
|US27|Active Offers|Medium|As a seller, I want to see the products that I am currently selling, so that I can keep track of the offer's state.|
|US28|Update Offer|Medium|As a seller, I want to update my product's price, so that I can better compete with other sellers.|
|US29|Exclude Offer|Medium|As a seller, I want to remove a previously published offer, so that I am no longer selling the product.|
|US30|Reply to Reports|Low|As a seller, I want to be able to reply to reports made against me, so that I can handle the situation and explain my motives to buyer and administrator.|
|US31|Batch Sell|Low| As a seller, I want to sell multiple keys of a product at the same time, so that selling multiple keys for the same product is much quicker and easier.|
|US32|Product Discount|Low|As a seller, I want to make discounts to my offers, so that it lowers the offers' price during a period of time.|
|US33|Receive payments using PayPal |Low| As a seller, I want to be able to use PayPal to receive my income, so that I use a secure payment method.|
# Responder aos reports

###### Table 6: Seller's user stories

### 2.5 Banned User
| Identifier | Name| Priority | Description|
| ---------- | ------------------------ | -------- | ---------------------------------------------------------------------------------------------------------------------------------- |
|US34|Unban appeal|Low| As a banned user, I want to appeal to the administrator of the website, so that my ban can be lifted.|

###### Table 6: Banned User's user stories

### 2.6. Administrator

|Identifier | Name| Priority | Description|
| ---------- | ------------------------ | -------- | ----------------------------------------------------------------------------------------------------------------------------- |
|US35|Add a Product| High | As an admin, I want to be able to add products to the database, so that I can keep the product's list always updated. |
|US36|Admin Login | High | As an admin, I want to be able to sign in, so that I get administrative privileges|
|US37|Admin Sign Out | High | As an admin, I want to be able to sign out, so that I'm no longer logged in.|
|US38|Product Search | Medium| As an admin, I want to be able to search for games by name, so that I can quickly access them.|
|US39|User Search | Medium| As an admin, I want to be able to search for users by name, so that I can quickly access them.|
|US40|User Ban| Medium| As an admin, I want to be able to block users, so that I can keep scammers away from the website|
|US41|Product Edit| Medium| As an admin, I want to be able to edit products in the database, so that the I can change each product information.|
|US42|Product Delete| Medium| As an admin, I want to be able to delete products in the database, so that that a faulty product entry in the database is removed.|
|US43|Access to Users' Reports|Medium| As an admin, I want to able to manage reports from users, so that I am able to take action and make the commmunity happier.|
|US44|Review Delete|Low|As an admin, I want to be able to delete offensive reviews, so that I can keep the order and respect on the website.|
|US45|Manage Game Categories|Low|As an admin, I want to be able to add, edit and remove a product category, so that I can better specify a game's category.|
|US46|Manage Gaming Platforms|Low|As an admin, I want to be able to add, edit and remove a gaming platform, so that I can better specify a game's platform.|
|US47|Manage Game Genres|Low|As an admin, I want to be able to add, edit and remove a product genre, so that I can better specify a game's genre.|
|US48|Manage FAQ|Low| As an admin, I want to be able to add, edit and remove a question of the FAQ, so that the FAQ is kept up-to-date.|
|US49|Check Transactions|Low|As an admin, I want to be able to see all transactions, so that I can keep track of the website's activity. |
|US50|Remove User Ban|Low|As an admin, I want to be able to unban a user, so that the user can buy and sell products again. |
|US51|Manage ban lift appeals|Low| As an admin, I want to be able to see all appeals made by banned users, so that I review their requests and issue a response.|

###### Table 7: Admin's user stories


### 2.7. API User

| Identifier | Name| Priority | Description|
| ---------- | --------------- | -------- | --------------------------------------------------------------------------------------------------------------------------------------------------- |
|US52|Search Products|Low| As an API user, I want to get a list of products that are available, so that I know which ones are available.|
|US53|Search Sellers|Low| As an API user, I want to get a list of sellers and their offers for a specific product, so that I can compare the offers of the different sellers.|
|US54|Sell a Product|Low| As an API user I want to be able to put an item on discount, so that I can sell that product.|
|US55|Buy a Product|Low| As an API user, I want to buy an offer of a product, so that I own the product.|

###### Table 8: API user's user stories


## A1. Annex: Supplementary requirements


### A1.1. Business rules


| Identifier | Name | Description|
| ---------- | ---------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
|BR01|Single Review| A buyer can only make one review of the seller per product transacion.|
|BR02|Review Feedback| While reviewing a seller, a buyer must give positive or negative feedback (thumbs up or down) and has the option to write a message explaining it as well as report the seller.|
|BR03|Seller Feedback| The seller's feedback rating consists of the average of all feedback received from all past sales.|
|BR04|User Ban| An administrator will have the option to ban an user from making transactions should he consider the user to not be trustworthy.Since the user won't be able to buy items he will not be capable of issuing future feedback to sellers, although he will still retain the possibility of reviewing past transactions. All keys on discount are automatically excluded from the website.|
|BR05| Seller Restriction| A seller cannot buy his an offer that he is currently sellling, and so he cannot make a review about himself.|
|BR06| User Account Deletion| When a user chooses to delete his account all received feedback and profile details are deleted, but all reviews given to sellers are mantained anonymously, furthermore all sold keys are maintained in the database to allow the buyers to see the keys. All keys being sold by this seller are automatically excluded from the website.|
|BR07| Product Deletion| When administrator deletes a product. If there is any trasanction completed associated with that product, the user must keep access to the bought key.|
|BR08|Age Restriction| User must be at least 18 years old to create an account.|
|BR09|Key Uniqueness| All redemption keys must be unique and so, when entered in the database and to make sure they are, they will be tested against all other keys in the database.|
|BR10|Transaction Fee| All transactions will impose a 5% fee as commission.|
|BR11|Payment Method| All transactions will be made using PayPal.|
|BR12|Offer Discount Date| When setting a discount date for a product it must be greater than the current date.|
|BR13|Review Date| The date of a review must be after the product's transaction date.|
|BR14|Ban Lift|Every banned user has the right to submit one appeal form to be reviewed by the administrator.|
|BR15|No Refund|There will be no possibility to ask for a refund after a successful transaction is completed.|
|BR16|Game Update Restriction|After pubishing an offer, a seller cannot change the game that he defined the keys belong to.|


###### Table 9: Business rules

### A1.2. Technical requirements
| Identifier | Name| Description|
| ---------- | --------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
|TR01| **Security**| The system shall protect information from unauthorised access through the use of an authentication system and the encryption of the sensitive data stored |
|TR02| **Concurrency**| The system must be prepared to handle errors that may occur when multiple users try to buy the same product in runtime.|
|TR03| **Usability**| The system should have a pratical interface for desktop and mobile users to be easy to buy and sell. |
|TR04| Accessibility| The system must ensure that everyone can access the pages, regardless of whether they have any handicap.|
|TR05|Performance| The system should have short response time and information upload.|
|TR06|Web Application | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3, PHP(Laravel) and Bootstrap 4.|
|TR07|Server Side Cross-Platform| The server-side system should work across multiple platforms(Linux or Windows).|
|TR08|User Side Browser Compatibility|The website should render in the most popular browsers(Chrome,Mozilla or Opera).|
|TR09|Database|The PostgreSQL 9.4 database management system must be used.|
|TR10|Scalability| The system must be prepared to handle an increase in the number of visitors, offers and transactions.|
|TR11|Ethics| The system must respect the ethical principles in software development. Furthermore data privacy must be guaranteed as well as a community free of offensive reviews.|

###### Table 10: Technical Requirements 

The most important technical requirements for this project are:
* **Security** - Since all products sold on the website are redemption keys a security failure will potentially lead to a catastrophic loss of revenue and costumer trust.
* **Robustness** - It is important for the website to be able to handle runtime errors, such as when 2 costumers try to buy the same offer at almost the same time so that they don't get the same key which can only be used once by only one of them. 
* **Usability** - The website should very simple and easy to use so customers can make purchase and sell products without any type of delay independently of the device they access it from.


### A1.3. Restrictions

| Identifier | Name | Description|
| ---------- | -------- | ---------------------------------------------------------------------------------------------------------------------------- |
|C01| Deadline | The system should be ready to be used at the end of the second semester|

###### Table 11: Restrictions


## Revision history

First submission date: 2020/02/26

First revision changes:
* Removed obvious/unneeded Business Rules;
* Moved User Stories from buyer and seller to authenticated user;
* Added User Story to administrator about shearching users;
* Changed name of user stories related to PayPal
* No Delete Games

***
## Team: 43
* José Guerra, up201706421@fe.up.pt (Editor)
* Luís Ramos, up201706253@fe.up.pt
* Martim Silva, up201705205@fe.up.pt
* Ruben Almeida, up201704618@fe.up.pt 
