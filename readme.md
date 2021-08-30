## Smart Tribune - Backend - Coding Test

### Instructions

Based on the following JSON payload as Question & Answer document

```
{
	"title": varchar 100 - required
	"promoted": boolean - required,
	"status": enum - required 
	"answers": [{
		"channel": enum - required,
		"body": varchar 500 - required
	}]
}
```

#### Step 01 :

Create an API to validate a Q&A and store into a database with following extra fields : createdAt, updatedAt 

Constraints : 
Answers.channel value is restricted to "faq" or "bot"
Status value is restricted to "draft" or "published"


#### Step 02 :

1. Update existing Q&A to change the value of the title and the status. 
2. Listen to changes on the question and populate a new entity HistoricQuestion with those changes.

#### Step 03 :

1. Create an exporter service which is be able to export any entity type content into CSV file
2. Use the previously created exporter in order to export HistoricQuestion datas

#### Bonus :

1. Dockerize the project and provide related readme file 
2. Explain how you would do it if you've been asked to populate HistoricQuestion asynchronously

---

### Download the project

Explain here how you can download your project 

---

### Installation - with Docker

#### Step 01 :

1. Make sure you have Docker installed on your machine first.
2. Otherwise, install Docker-Desktop: https://www.docker.com/get-started

#### Step 02 : 

1. Open a CMD Console (_for Windows_) or a Terminal, and go into the project folder.
2. We need to build our `PHP - Apache` docker image with this command:

```bash
docker-compose build
```
3. From now, we need to compose our first container with Docker. He'll use multiple images (_Apache + MariaDB + phpMyAdmin_) for create a development environment dedicated to our Symfony application. Run this command into your console / terminal.
```bash
docker-compose up -d
```
4. Open a browser and go to :
- [symfony App](http://127.0.0.1:8080/) => 127.0.0.1:8080 for access to our Symfony application 
- [phpMyAdmin](http://127.0.0.1:8888/) => 127.0.0.1:8888 for access to our phpMyAdmin (_login: root, no password_)