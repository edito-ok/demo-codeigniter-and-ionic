import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Datemodal } from './home/datemodal.modal';
@Injectable({ providedIn: 'root' })
export class UserServiceService {
  private datetime: Datemodal
  constructor(private http: HttpClient) {
  }

  getDate() {
    var headers = new Headers();
    headers.append("Accept", 'application/json');
    headers.append('Content-Type', 'application/json');

    return this.http.get(
      'https://randomuser.me/api/?results=25');
    //http://editodemo.000webhostapp.com/demo/index.php/welcome/get
  }
  postDate(model: Datemodal) {
    let postData = {
      "id": model.id,
      "date": model.datetime
    }
    return this.http.post("http://127.0.0.1:3000/customers", postData);
  }
}
