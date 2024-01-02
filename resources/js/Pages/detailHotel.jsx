import { useState, useEffect } from "react";
import api from "@/api";
import GeneralLayout from "@/layouts/general";
import { usePage } from "@inertiajs/react";

export default function detailHotel() {
    const [isLoading, setIsLoading] = useState(true);
    const [hotel, setHotel] = useState({});
    const roomCode = usePage().props.id;
    useEffect(() => {
        const fetchData = async () => {
            setIsLoading(true);
            const hotelDetailRequest = await api.get(`/hotel/${roomCode}`);

            try {
                const [hotelResponse] = await Promise.all([hotelDetailRequest.data]);
                setHotel(hotelResponse[0]);
                console.log(hotelResponse);
            } catch (error) {
                console.log(error);
            } finally {
                setIsLoading(false);
            }
        };
        fetchData();
    }, []);

    return (
        <GeneralLayout isLoading={isLoading}>
            <div className="flex flex-col gap-7">
                <div className="flex w-full gap-2">
                    <div className="flex w-full">
                        <div className="flex w-full">
                            <img src="https://placehold.co/500x400" alt="" />
                        </div>
                        <div className="flex flex-col justify-center">
                            <h1 className="text-2xl font-bold">{hotel.name}</h1>
                            <p>{hotel.rating}</p>
                            <p>{hotel.address}</p>
                        </div>
                    </div>
                    <div className="flex flex-col w-1/4 justify-center items-center">
                        <p className="font-semibold">{hotel.price}</p>
                        <button
                            type="submit"
                            className="w-fit px-2 py-1 bg-green-400 font-semibold rounded-lg"
                        >
                            Book Now
                        </button>
                    </div>
                </div>
                {/* <div className="flex flex-col w-full">
                    <h1 className="text-2xl font-bold">See Other Hotels</h1>
                    <div className="">
                        {hotels.map((hoteltel) => (
                            <Card
                                key={hoteltel.code}
                                image="https://flowbite.com/docs/images/blog/image-1.jpg"
                                title={hoteltel.name}
                                rating="4"
                                price="599"
                                action="Book Now"
                            />
                        ))}
                    </div>
                </div> */}
            </div>
        </GeneralLayout>
    );
}
