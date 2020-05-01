import { Component, OnInit } from '@angular/core';
import { UserServiceService } from '../user-service.service';
import { Datemodal } from './datemodal.modal';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit {
  model: Datemodal = null;
  status: Number = 0;
  value: String;
  countDownDate: number;
  constructor(private service: UserServiceService) { }

  ngOnInit() {
    var hompage = this;
    this.service.getDate()
      .subscribe(
        (data) => {
          var sa = data['results'];
          hompage.model = { 'id': 1, 'datetime': new Date() };
          hompage.countDownDate = this.model.datetime.getTime();
          hompage.status = 0;
          hompage.value = this.getdate() + " " + this.gettime();
          hompage.load();
        },
        (error) => {
          console.error(error);
        }
      );

  }


  load() {
    var aux = this;
    setInterval(function () {
      aux.countDownDate = aux.countDownDate + 10;
      if (aux.status != 0) {
        var format = aux.getdate() + " " + aux.gettime();
        aux.value = format;
      }
      if (aux.status == 2) {
        aux.changeModel();
        aux.status = 1;
      }
    }.bind(this), 10);
  }

  gettime() {
    var hours = Math.floor((this.countDownDate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((this.countDownDate % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((this.countDownDate % (1000 * 60)) / 1000);
    return hours + ":" + minutes + ":" + seconds;
  }
  getdate() {

    var date = this.model.datetime.toJSON().slice(0, 10);
    var day = date.slice(8, 10);
    var month = date.slice(5, 7);
    var year = date.slice(0, 4);
    return year + "-" + month + "-" + day;
  }
  start() {
    this.status = 1;
  }
  pause() {
    this.status = 0;
  }
  change() {
    this.status = 2;
  }
  changeModel() {
    var homePage = this;
    var date = new Date(this.getdate + " " + this.gettime());
    var data = {
      'id': this.model.id,
      'datetime': date
    }
    this.service.postDate(data)
      .subscribe(
        (data) => {
          var sa = data['results'];
          homePage.model = { 'id': 1, 'datetime': new Date() };
          homePage.countDownDate = this.model.datetime.getTime();
          homePage.status = 0;
          homePage.value = this.getdate() + " " + this.gettime();
          homePage.load();
        },
        (error) => {
          console.error(error);
        }
      );

  }
}
