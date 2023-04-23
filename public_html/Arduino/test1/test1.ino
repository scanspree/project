#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//----------------------------------------Include the SPI and MFRC522 libraries-------------------------------------------------------------------------------------------------------------//
//----------------------------------------Download the MFRC522 / RC522 library here: https://github.com/miguelbalboa/rfid
#include <SPI.h>
#include <MFRC522.h>
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

#define SS_PIN D2  //--> SDA / SS is connected to pinout D2
#define RST_PIN D1  //--> RST is connected to pinout D1
MFRC522 mfrc522(SS_PIN, RST_PIN);  //--> Create MFRC522 instance.

#define ON_Board_LED 2  //--> Defining an On Board LED, used for indicators when the process of connecting to a wifi router

#define BUZZER_PIN D0


//const char* ssid = "Redmi11"; /* Add your router's SSID */
//const char* password = "12345678*"; /*Add the password */

//const char* ssid = "Galaxy A50s2DD4";
//const char* password = "qedn0439";
const char* ssid = "Vtstar";
const char* password = "12348765";

const char fingerprint[] PROGMEM = "C5 55 0D 52 22 C5 08 02 03 76 04 83 2B 68 29 D1 18 82 86 66";

const char* host = "scanspree.shop";



int readsuccess;
byte readcard[4];
char str[32] = "";
String StrUID;

String strs[20]; 
int StringCount=0;
String userid= "\n ";
int b;

WiFiServer espServer(80); /* Instance of WiFiServer with port number 80 */
/* 80 is the Port Number for HTTP Web Server */
void setup() 
{
  Serial.begin(115200); /* Begin Serial Communication with 115200 Baud Rate */
  /* Configure GPIO4 and GPIO5 Pins as OUTPUTs */
  
  Serial.print("\n");
  Serial.print("Connecting to: ");
  Serial.println(ssid);
  WiFi.mode(WIFI_STA); /* Configure ESP8266 in STA Mode */
  WiFi.begin(ssid, password); /* Connect to Wi-Fi based on above SSID and Password */
  pinMode(ON_Board_LED, OUTPUT);
  pinMode(BUZZER_PIN, OUTPUT);   
  digitalWrite(ON_Board_LED, HIGH); 
  while(WiFi.status() != WL_CONNECTED)
  {
    Serial.print("*");
digitalWrite(ON_Board_LED, LOW);
    delay(250);
    digitalWrite(ON_Board_LED, HIGH);
    delay(250);    
  }
  digitalWrite(ON_Board_LED, HIGH); 
  Serial.print("\n");
  Serial.print("Connected to Wi-Fi: ");
  Serial.println(WiFi.SSID());
  delay(100);
  Serial.println("Starting ESP8266 Web Server...");
  espServer.begin(); /* Start the HTTP web Server */
  Serial.println("ESP8266 Web Server Started");
  Serial.print("The URL of ESP8266 Web Server is: ");
  Serial.print("http://");
  Serial.println(WiFi.localIP());
  //if (MDNS.begin("esp8266")) {  //Start mDNS with name esp8266.local
  //    Serial.println("MDNS started");
   // }

}



void loop()
{
  WiFiClient client = espServer.available(); /* Check if a client is available */
  if(client)
  {
    Serial.println("New Client!!!");

  String request = client.readStringUntil('\r'); /* Read the first line of the request from client */
  Serial.println(request); /* Print the request on the Serial monitor */
  /* The request is in the form of HTTP GET Method */ 
  // Split the string into substrings

  if (request.indexOf("/buzzer/on") != -1) { // handle request to turn on buzzer
    digitalWrite(BUZZER_PIN, HIGH);
  // wait for 500 milliseconds
  delay(500);
  // turn the buzzer off
  digitalWrite(BUZZER_PIN, LOW);
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println("");
  client.println("<html><body><h1>Deactivated Tag Scanned</h1></body></html>");
  // wait for 1 second before the next cycle
    }
    else if (request.indexOf("/reset") != -1) { // handle request to reset ESP8266
      ESP.restart();
       client.println("HTTP/1.1 200 OK");
       client.println("Content-Type: text/html");
       client.println("");
       client.println("<html><body><h1>ESP Reseted</h1></body></html>");
    }
    else {
      // handle other requests
      
  while (request.length() > 0)
  {
     
    int index = request.indexOf(' ');
    if (index == -1) // No space found
    {
      strs[StringCount++] = request;
      break;
    }
    else
    {
      strs[StringCount++] = request.substring(0, index);
      request = request.substring(index+1);
    }
  }
     client.println("HTTP/1.1 200 OK");
       client.println("Content-Type: text/html");
       client.println("");
       client.println("<html><body><h1>Please Wait</h1><h1>Sending Request to the ESP</h1></body></html>");
  // Show the resulting substrings
  for (int i = 0; i < StringCount; i++)
  {
    Serial.print(i);
    Serial.print(": \"");
    Serial.print(strs[i]);
    Serial.println("\"");
  }
  String user = "read"+strs[1];

  Serial.println(user);
  String array[2];  
  int y = 0 ;

    for ( int i = 0 ; i < user.length() ; i ++ )  {

      if ( user.charAt(i) == '/' ) { y++;  }

       else { array[y] +=  user.charAt(i) ;  }
    }
  userid= array[1];
    }


  client.flush();

  client.stop();
  Serial.println("Client disconnected");
  Serial.print("\n");

  if(userid != " "|| userid!= NULL){
    
  SPI.begin();      //--> Init SPI bus
  mfrc522.PCD_Init(); //--> Init MFRC522 card 

  
    }

 
}
   
 
    



 
 readsuccess = getid();
   if (readsuccess) {
    digitalWrite(ON_Board_LED, LOW);
     WiFiClientSecure httpsClient;    //Declare object of class WiFiClient
Serial.println(StrUID);
Serial.println(userid);
  Serial.println(host);
const int httpsPort = 443; 

  Serial.printf("Using fingerprint '%s'\n", fingerprint);
  httpsClient.setFingerprint(fingerprint);
 // httpsClient.setTimeout(15000); // 15 Seconds
  delay(1000);
  
  Serial.print("HTTPS Connecting");
  int r=0; //retry counter
  while((!httpsClient.connect(host, httpsPort)) && (r < 30)){
      delay(100);
      Serial.print(".");
      r++;
  }
  if(r==30) {
    Serial.println("Connection failed");
  }
  else {
    Serial.println("Connected to web");
  }
  
  String Link;
  
  //POST Data
  Link = "/demo.php";

  Serial.print("requesting URL: ");
  Serial.println(host);
  /*
   POST /post HTTP/1.1
   Host: postman-echo.com
   Content-Type: application/x-www-form-urlencoded
   Content-Length: 13
  
   say=Hi&to=Mom
    
   */
String UIDresultSend=StrUID;

String data = "UIDresult="+UIDresultSend+"&id="+userid+"&esp=ESP30";
Serial.print(data);
//strcat(UIDresult,UIDresultdata);
  httpsClient.print(String("POST ") + Link + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded"+ "\r\n" +
               "Content-Length:"+String(data.length()) + "\r\n\r\n" +
               data + "\r\n" +
               "Connection: close\r\n\r\n");

  Serial.println("request sent");
                  
  while (httpsClient.connected()) {
    String line = httpsClient.readStringUntil('\n');
    if (line == "\r") {
      Serial.println("headers received");
      break;
    }
  }

  Serial.println("reply was:");
  Serial.println("==========");
  String line;
  while(httpsClient.available()){        
    line = httpsClient.readStringUntil('\n');  //Read Line by Line
    Serial.println(line); //Print response
  }
  Serial.println("==========");
  Serial.println("closing connection");
    
  delay(2000); 
    digitalWrite(ON_Board_LED, HIGH);
  }    
    
}
int getid() {
  if (!mfrc522.PICC_IsNewCardPresent()) {
    return 0;
  }
  if (!mfrc522.PICC_ReadCardSerial()) {
    return 0;
  }


  Serial.print("THE UID OF THE SCANNED CARD IS : ");

  for (int i = 0; i < 4; i++) {
    readcard[i] = mfrc522.uid.uidByte[i]; //storing the UID of the tag in readcard
    array_to_string(readcard, 4, str);
    StrUID = str;
  }
  mfrc522.PICC_HaltA();
  return 1;
}
//------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//

//----------------------------------------Procedure to change the result of reading an array UID into a string------------------------------------------------------------------------------//
void array_to_string(byte array[], unsigned int len, char buffer[]) {
  for (unsigned int i = 0; i < len; i++)
  {
    byte nib1 = (array[i] >> 4) & 0x0F;
    byte nib2 = (array[i] >> 0) & 0x0F;
    buffer[i * 2 + 0] = nib1  < 0xA ? '0' + nib1  : 'A' + nib1  - 0xA;
    buffer[i * 2 + 1] = nib2  < 0xA ? '0' + nib2  : 'A' + nib2  - 0xA;
  }
  buffer[len * 2] = '\0';
}

