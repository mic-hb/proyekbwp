import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import { usePage } from "@inertiajs/react";
import { Carousel } from "flowbite-react";
import Rating from "@/components/rating";

export default function detailHotel() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotel, setHotel] = useState({});
    const [room, setRoom] = useState([]);
    const hotelCode = usePage().props.id;
    const [image_urls, setImage_urls] = useState([]);
    const [bookData, setBookData] = useState({});
    const handleBooking = async(roomCode, lowest_price) => {
        setBookData(
            {
            room_type_code: roomCode,
            hotel_code: hotel.code,
            lowest_price: lowest_price,
        });
        const bookRequest = await api.post("/bookings/setup", bookData);
        if (bookRequest.status === 200) {
            window.location.href = "/book";
        }
    }

    useEffect(() => {
        console.log(bookData);
    }, [bookData]);

    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelDetailRequest = await api.get(`/hotel/${hotelCode}`);
            const roomDetailRequest = await api.get(`/hotel/${hotelCode}/rooms`);

            try {
                const [hotelResponse] = await Promise.all([
                    hotelDetailRequest.data,
                ]);
                const [roomResponse] = await Promise.all([
                    roomDetailRequest.data,
                ]);
                setHotel(hotelResponse[0]);
                setRoom(roomResponse);
                hotelResponse[0].image_urls.map((image) => {
                    image_urls.push(image);
                });
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, [setHotel]);

    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="flex flex-col gap-8 w-full">
                <div className="flex flex-col w-full gap-2">
                    <div className="flex flex-col w-full">
                        <div className="flex w-full aspect-video">
                            <Carousel pauseOnHover slideInterval={2500}>
                                {image_urls.map((image, index) => (
                                    <img key={index} src={image} alt="..." />
                                ))}
                            </Carousel>
                        </div>
                        <div className="flex flex-col justify-center p-4">
                            <h1 className="text-2xl font-bold">{hotel.name}</h1>
                            <Rating rating={hotel.average_rating} />
                            <p>{hotel.address}</p>
                            <p>{hotel.city_name}</p>
                            {room.map((room) =>
                                room.isAvailable ? (
                                    <div
                                        key={room.code}
                                        className="flex flex-col gap-2 border rounded-lg px-2 py-1 shadow-md"
                                    >
                                        <div className="flex flex-col justify-between">
                                            <h1 className="text-xl font-semibold">
                                                {room.name}
                                            </h1>
                                            <img
                                                src={room.image_urls[0]}
                                                alt=""
                                                className="w-32 rounded-lg"
                                            />
                                            <p className="text-lg">
                                                Facilites Included:{" "}
                                                {room.facilities}
                                            </p>
                                            <p className="text-lg font-semibold">
                                                Rp. {room.lowest_price}
                                            </p>
                                            <p>{room.description}</p>
                                        </div>
                                        <button onClick={() => handleBooking(room.code, room.lowest_price)} className="px-4 p-2 bg-green-400 rounded-md hover:bg-green-500 font-semibold text-xl">
                                            Book Now
                                        </button>
                                    </div>
                                ) : null
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </GeneralLayout>
    );
}
