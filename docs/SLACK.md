# Slack App Installation & Token Retrieval

### Navigate to your Slack workspace App page:

https://{your-slack-workspace}.slack.com/apps

### Click the 'Build' button near the workspace selector

![image](https://bw-public-images.s3-us-east-2.amazonaws.com/apps-home.png)

### Click the 'Create an app' button

![image](https://bw-public-images.s3-us-east-2.amazonaws.com/create-app.png)

### Select the 'From scratch' option

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/from-scratch.png" alt="from-scratch" width="50%">

### Name your app & choose your workspace

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/name-app.png" alt="name" width="50%">

### Click the permissions button on your app info page

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/permissions.png" alt="permissions" width="50%">

### On the permissions page, scroll down to the Scopes card, select the Bot Scopes as show below

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/chat-write-scope.png" alt="scopes" width="75%">

### Scroll back to the top of the page, click the Install to Workspace button, and follow the flow to complete the app installation

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/install.png" alt="scopes" width="75%">

### Grab your token and paste it to your env file

<img src="https://bw-public-images.s3-us-east-2.amazonaws.com/token.png" alt="scopes" width="75%">


Add the key and token to your `.env` file

```shell
SLACK_OAUTH_TOKEN=############################
```

