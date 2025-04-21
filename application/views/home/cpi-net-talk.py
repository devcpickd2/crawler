import wx
import googleapiclient.discovery
import mysql.connector
from mysql.connector import Error
from datetime import datetime

# YouTube API setup
api_service_name = "youtube"
api_version = "v3"
DEVELOPER_KEY = "AIzaSyBflfeHCmNmiKbyTncKICuKvic-W1HaSOY"  # Replace with your actual API key

youtube = googleapiclient.discovery.build(
    api_service_name, api_version, developerKey=DEVELOPER_KEY
)

def search_videos(query, max_results=10):
    request = youtube.search().list(
        q=query,
        part="id,snippet",
        type="video",
        maxResults=max_results
    )
    response = request.execute()
    return [{
        'videoId': item['id']['videoId'],
        'title': item['snippet']['title'],
        'channelTitle': item['snippet']['channelTitle']
    } for item in response['items']]

def check_comments_enabled(video_id):
    try:
        request = youtube.commentThreads().list(
            part="snippet",
            videoId=video_id,
            maxResults=1
        )
        request.execute()
        return True
    except:
        return False

def get_video_details(video_id):
    request = youtube.videos().list(
        part="snippet,statistics",
        id=video_id
    )
    response = request.execute()

    if response['items']:
        video = response['items'][0]
        tags = video.get('snippet', {}).get('tags', [])
        total_views = int(video['statistics'].get('viewCount', 0))
        video_id_like = int(video['statistics'].get('likeCount', 0))
        total_comments = int(video['statistics'].get('commentCount', 0))
        engagement_rate = calculate_engagement_rate(video_id_like, total_comments, total_views)
        return {
            'tags': tags,
            'total_views': total_views,
            'engagement_rate': engagement_rate,
            'video_id_like': video_id_like,
            'channel_title': video['snippet'].get('channelTitle', '')
        }
    return {}

def calculate_engagement_rate(video_id_like, total_comments, total_views):
    if total_views > 0:
        return ((video_id_like + total_comments) / total_views) * 100
    return 0

class YouTubeKeywordManager(wx.Frame):
    def __init__(self, *args, **kw):
        super(YouTubeKeywordManager, self).__init__(*args, **kw)
        self.InitUI()

    def InitUI(self):
        panel = wx.Panel(self)
        vbox = wx.BoxSizer(wx.VERTICAL)

        hbox1 = wx.BoxSizer(wx.HORIZONTAL)
        lbl_keyword = wx.StaticText(panel, label="Keyword:")
        hbox1.Add(lbl_keyword, flag=wx.RIGHT, border=8)
        self.txt_keyword = wx.TextCtrl(panel)
        hbox1.Add(self.txt_keyword, proportion=1)
        vbox.Add(hbox1, flag=wx.EXPAND | wx.ALL, border=10)

        btn_search = wx.Button(panel, label="Search Videos")
        btn_search.Bind(wx.EVT_BUTTON, self.OnSearch)
        vbox.Add(btn_search, flag=wx.EXPAND | wx.ALL, border=10)

        btn_display = wx.Button(panel, label="Display All Keywords")
        btn_display.Bind(wx.EVT_BUTTON, self.OnDisplayKeywords)
        vbox.Add(btn_display, flag=wx.EXPAND | wx.ALL, border=10)

        btn_new_data = wx.Button(panel, label="Display New Data")
        btn_new_data.Bind(wx.EVT_BUTTON, self.OnDisplayNewData)
        vbox.Add(btn_new_data, flag=wx.EXPAND | wx.ALL, border=10)

        btn_delete = wx.Button(panel, label="Delete Keyword")
        btn_delete.Bind(wx.EVT_BUTTON, self.OnDeleteKeyword)
        vbox.Add(btn_delete, flag=wx.EXPAND | wx.ALL, border=10)

        btn_exit = wx.Button(panel, label="Exit")
        btn_exit.Bind(wx.EVT_BUTTON, self.OnExit)
        vbox.Add(btn_exit, flag=wx.EXPAND | wx.ALL, border=10)

        panel.SetSizer(vbox)

        self.SetTitle("YouTube Keyword Manager")
        self.SetSize((400, 400))
        self.Centre()

    def OnSearch(self, event):
        keyword = self.txt_keyword.GetValue()
        if keyword:
            video_data = search_videos(keyword)
            enabled_videos = [data for data in video_data if check_comments_enabled(data['videoId'])]
            results = ""
            for video in enabled_videos:
                video_details = get_video_details(video['videoId'])
                results += f"Video: {video['title']}\n"
                results += f"Channel: {video['channelTitle']}\n"
                results += f"Tags: {', '.join(video_details.get('tags', ''))}\n"
                results += f"Engagement Rate: {video_details.get('engagement_rate', 0)}%\n"
                results += f"Total Views: {video_details.get('total_views', 0)}\n"
                results += f"Total Likes: {video_details.get('video_id_like', 0)}\n\n"

                self.insert_video_data(video['videoId'], keyword, video['title'], video_details)

            wx.MessageBox(results, "Search Results", wx.OK | wx.ICON_INFORMATION)
        else:
            wx.MessageBox("Please enter a keyword.", "Input Error", wx.OK | wx.ICON_WARNING)

    def insert_video_data(self, video_id, keyword, title, video_details):
        try:
            connection = mysql.connector.connect(
                host='localhost',
                database='ripple',
                user='root',
                password=''
            )
            cursor = connection.cursor()
            cursor.execute("SELECT video_id FROM youtube_data_2 WHERE video_id = %s", (video_id,))
            if cursor.fetchone() is None:
                insert_query = """
                INSERT INTO youtube_data_2 (keyword, video_id, title, title_newdata, tags, engagement_rate, total_views, video_id_like, channel_name, created_at)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                """
                cursor.execute(insert_query, (
                    keyword,
                    video_id,
                    title,
                    title,
                    ', '.join(video_details.get('tags', [])),
                    video_details.get('engagement_rate', 0),
                    video_details.get('total_views', 0),
                    video_details.get('video_id_like', 0),
                    video_details.get('channel_title', ''),
                    datetime.now()
                ))
                connection.commit()
        except Error as e:
            wx.MessageBox(f"Error: {e}", "Database Error", wx.OK | wx.ICON_ERROR)
        finally:
            if connection.is_connected():
                cursor.close()
                connection.close()

    def OnDisplayKeywords(self, event):
        try:
            connection = mysql.connector.connect(
                host='localhost',
                database='ripple',
                user='root',
                password=''
            )
            cursor = connection.cursor()
            cursor.execute("SELECT DISTINCT keyword FROM youtube_data_2")
            keywords = cursor.fetchall()
            keywords_list = "\n".join(keyword[0] for keyword in keywords)
            wx.MessageBox(keywords_list, "Keywords in Database", wx.OK | wx.ICON_INFORMATION)
        except Error as e:
            wx.MessageBox(f"Error: {e}", "Database Error", wx.OK | wx.ICON_ERROR)
        finally:
            if connection.is_connected():
                cursor.close()
                connection.close()

    def OnDisplayNewData(self, event):
        try:
            connection = mysql.connector.connect(
                host='localhost',
                database='ripple',
                user='root',
                password=''
            )
            cursor = connection.cursor()
            # Updated query to filter only entries with non-empty title_newdata
            cursor.execute("SELECT title_newdata, created_at FROM youtube_data_2 WHERE title_newdata IS NOT NULL AND title_newdata != '' ORDER BY created_at DESC")
            new_data = cursor.fetchall()
            if new_data:
                new_data_list = "\n".join(f"{row[0]} (added on {row[1]})" for row in new_data)
                wx.MessageBox(new_data_list, "New Data in Database", wx.OK | wx.ICON_INFORMATION)
            else:
                wx.MessageBox("No new data found.", "Info", wx.OK | wx.ICON_INFORMATION)
        except Error as e:
            wx.MessageBox(f"Error: {e}", "Database Error", wx.OK | wx.ICON_ERROR)
        finally:
            if connection.is_connected():
                cursor.close()
                connection.close()

    def OnDeleteKeyword(self, event):
        keyword = self.txt_keyword.GetValue()
        if keyword:
            try:
                connection = mysql.connector.connect(
                    host='localhost',
                    database='ripple',
                    user='root',
                    password=''
                )
                cursor = connection.cursor()
                delete_query = "DELETE FROM youtube_data_2 WHERE keyword = %s"
                cursor.execute(delete_query, (keyword,))
                connection.commit()
                wx.MessageBox("Keyword deleted successfully.", "Success", wx.OK | wx.ICON_INFORMATION)
            except Error as e:
                wx.MessageBox(f"Error: {e}", "Database Error", wx.OK | wx.ICON_ERROR)
            finally:
                if connection.is_connected():
                    cursor.close()
                    connection.close()
        else:
            wx.MessageBox("Please enter a keyword to delete.", "Input Error", wx.OK | wx.ICON_WARNING)

    def OnExit(self, event):
        self.Close()

if __name__ == "__main__":
    app = wx.App()
    frame = YouTubeKeywordManager(None)
    frame.Show()
    app.MainLoop()
