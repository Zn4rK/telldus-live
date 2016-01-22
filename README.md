# Telldus Live PHP API

In anticipation of the [local support (4 years now!)](http://developer.telldus.se/ticket/114) for [Tellstick Net](http://www.telldus.se/products/tellstick_net), I've decided to write this API to facilitate the process of creating your own interfaces and other cool stuff you can do with the hardware.

I was worried a bit about the latency by using this API, but it seems to work almost instantly.

I couldn't find any good PHP-SDK's for Telldus, so I've written my own. Feel free to use it, and help me make it better. 

Right now we're lacking unit tests, since I honestly couldn't be bothered to "reverse engineer" their API. 

The only documentation I've found is the one [located here](http://api.telldus.com/explore/index). And it's lacking examples for all of their requests.

Since I only have codeswitches I have done my best to keep the phpdoc correct (ie. Thoose are the ones I could test for real).

There's two examples included in this project, which should get you started. 

## Contributing
* This project needs tests. If you have any ideas please let me know. 
* The Api\Event-class has almost no implementations. The basic framework is there, but the different methods needs to be implemented. 
* A thought was to specify Entity and Collection classes for lists and objects. Since I, again, didn't find any return examples I decided against this. I'm still open for the idea though.

## License
MIT
