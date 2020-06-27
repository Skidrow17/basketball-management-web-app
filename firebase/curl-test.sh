#!/bin/bash
curl -X POST -H "Authorization: key=AAAApMEIeNU:APA91bEfkVs_--4jAPOVgmaoB3FL6mz1EDLyMki3ftV3mpazrF4PNsnC1UWL25jWHos0rydUNxO48ro9lFNRWYO0MMizo3yZxiriiDj69GbIzBdCv2NYMzQdPZ5Jyx_6jL3mK_6UIFG8" -H "Content-Type: application/json" \
   -d '{
  "data": {
    "notification": {
        "title": "FCM Message",
        "body": "This is an FCM Message",
        "icon": "/itwonders-web-logo.png",
    }
  },
  "to": "cqiIPCqN-yd57RJpmMp32Y:APA91bEX-k1DimgVgKK6W4J-skwNwbje1EiPwJUa4yQnsfMaIp_P4QXM7C9t1YK_YB2RtUEHdxJP7V_e7JXkCQxv4inDRJUxvGJuQV-VJNCNc8aaVHVLqICqw6qID1GCvL0dVTYE_G-i"
}' https://fcm.googleapis.com/fcm/send
