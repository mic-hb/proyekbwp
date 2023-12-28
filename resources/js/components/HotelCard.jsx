import React from "react";
import ReactDOM from "react-dom";

export default function HotelCard() {
    return (
        <a href="#">
            <div className="flex w-full shadow-lg rounded-lg ">
                <div className="flex w-1/3">
                    <img
                        src="https://placehold.co/400x300"
                        alt=""
                        className="rounded-l-lg"
                    />
                </div>
                <div className="flex flex-col w-1/3 gap-2 px-1 py-2 justify-center">
                    <h1>Nama Hotel</h1>
                    <p>Rating: ⭐⭐⭐</p>
                    <div className="flex">
                        <p>Alamat</p>
                    </div>
                </div>
                <div className="flex flex-col w-1/3 gap-2 justify-center items-center">
                    <div className="flex flex-col w-1/2 justify-center text-center items-center gap-2 bg-green-300 border-2 border-green-500 px-2 py-1 rounded-lg ">
                        <h1>Harga</h1>
                        <button
                            type="submit"
                            className="bg-blue-600 w-full px-2 py-1 rounded-lg text-white font-semibold"
                        >
                            Book Now
                        </button>
                    </div>
                    <button
                        type="submit"
                        className="bg-pink-500 w-1/2 px-2 py-1 rounded-lg text-white font-semibold"
                    >
                        Add to Favorite
                    </button>
                </div>
            </div>
        </a>
    );
}

if (document.getElementById("home-hotelcard")) {
    ReactDOM.render(<HotelCard />, document.getElementById("home-hotelcard"));
}
