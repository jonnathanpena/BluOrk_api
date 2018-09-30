package routers

import (
	"github.com/gorilla/mux"
)

func InitRouters() *mux.Router {
	router := mux.NewRouter().StrictSlash(false)
	//Rutas de la api
	router = setApiBluOrkRouters(router)
	return router
}