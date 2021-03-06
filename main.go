package main

import(
	"net/http"
	"./common"
	"./routers"
)

func main() {
	common.StartUp()
	router := routers.InitRouters()
	server := &http.Server{
		Addr:    common.AppConfig.Server,
		Handler: router,
	}
	server.ListenAndServe()
}